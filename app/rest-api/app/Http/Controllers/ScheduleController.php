<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ScheduleService;
use Exception;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private ScheduleService $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function getAllDays()
    {
        try {
            $data = $this->scheduleService->getAllDay();

            return $this
                ->renderSuccess(
                    "Berhasil mengambil data hari.",
                    $data,
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function create(Request $r)
    {
        try {
            $newData = $r->input();
            $data = $this->scheduleService->create($newData);

            return $this
                ->renderSuccess(
                    "Berhasil membuat jadwal baru.",
                    $data,
                    201
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function delete(string $id)
    {
        try {
            $data = $this->scheduleService->deleteById($id);

            return $this
                ->renderSuccess(
                    "Berhasil menghapus jadwal.",
                    [$data],
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function activate(string $id)
    {
        try {
            $data = $this->scheduleService->activate($id);

            return $this
                ->renderSuccess(
                    "Berhasil mengaktifkan jadwal.",
                    [$data],
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    public function deactivate(string $id)
    {
        try {
            $data = $this->scheduleService->deactivate($id);

            return $this
                ->renderSuccess(
                    "Berhasil menonaktifkan jadwal.",
                    [$data],
                    200
                );
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }
}
