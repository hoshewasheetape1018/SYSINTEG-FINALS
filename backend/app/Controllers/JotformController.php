<?php

namespace App\Controllers;

use App\Libraries\JotformService;
use RuntimeException;
use Throwable;

class JotformController extends BaseController
{
    public function syncOrder($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('type') !== 'admin') {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Admin access required.']);
        }

        try {
            $result = (new JotformService())->syncOrderById((int) $id);
            $statusCode = $result['status'] === 'not_configured' ? 503 : 200;
            return $this->response->setStatusCode($statusCode)->setJSON($result);
        } catch (RuntimeException $exception) {
            return $this->response->setStatusCode(422)->setJSON(['status' => 'error', 'message' => $exception->getMessage()]);
        } catch (Throwable $exception) {
            log_message('error', 'Unexpected Jotform retry error: {message}', ['message' => $exception->getMessage()]);
            return $this->response->setStatusCode(502)->setJSON(['status' => 'error', 'message' => 'Jotform synchronization failed.']);
        }
    }
}
