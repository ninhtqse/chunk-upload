<?php

namespace Ninhtqse\Laravel\ChunkUpload\Handler\Traits;

use Ninhtqse\Laravel\ChunkUpload\Exceptions\ChunkSaveException;
use Ninhtqse\Laravel\ChunkUpload\Save\ParallelSave;
use Ninhtqse\Laravel\ChunkUpload\Storage\ChunkStorage;

trait HandleParallelUploadTrait
{
    protected $percentageDone = 0;

    /**
     * @return int
     */
    abstract public function getTotalChunks();

    /**
     * Returns the chunk save instance for saving.
     *
     * @param ChunkStorage $chunkStorage the chunk storage
     *
     * @return ParallelSave
     *
     * @throws ChunkSaveException
     */
    public function startSaving($chunkStorage)
    {
        // Build the parallel save
        return new ParallelSave(
            $this->file,
            $this,
            $chunkStorage,
            $this->config
        );
    }

    public function getPercentageDone()
    {
        return $this->percentageDone;
    }

    /**
     * Sets percentegage done - should be calculated from chunks count.
     *
     * @param int $percentageDone
     *
     * @return HandleParallelUploadTrait
     */
    public function setPercentageDone(int $percentageDone)
    {
        $this->percentageDone = $percentageDone;

        return $this;
    }
}
