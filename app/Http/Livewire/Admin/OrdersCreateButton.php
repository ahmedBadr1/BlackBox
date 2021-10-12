<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\ImportOrdersAdmin;
use App\Notifications\DoneNotification;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class OrdersCreateButton extends Component
{
    use WithFileUploads;

    public $batchId;
    public $importFile;
    public $importing = false;
    public $importFilePath;
    public $importFinished = false;
    public $importon = false;


    public function render()
    {
        return view('livewire.admin.orders-create-button');
    }
    public function on(){
        $this->importon = true;
    }

    /**
     * @throws \Throwable
     */
    public function import()
    {
        $this->validate([
            'importFile' => 'required',
        ]);

        $this->importing = true;
        $this->importFilePath = $this->importFile->store('imports');

        $batch = Bus::batch([
            new ImportOrdersAdmin($this->importFilePath),
        ])->dispatch();
        $this->batchId = $batch->id;

    }

    public function getImportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        $this->importFinished = $this->importBatch->finished();

        if ($this->importFinished) {
            Storage::delete($this->importFilePath);
            $this->importing = false;
        }
    }

}
