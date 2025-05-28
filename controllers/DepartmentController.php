<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/DepartmentModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class DepartmentController {
    private $departmentModel;

    public function __construct() {
        $this->departmentModel = new DepartmentModel();
    }

    private function isAdmin() {
        return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
    }

    public function create($data) {
        if (!$this->isAdmin()) {
            return ['status' => 'fail', 'message' => 'Admin only'];
        }

        $name = trim($data['name'] ?? '');

        if (!$name) {
            return ['status' => 'fail', 'message' => 'Department name is required'];
        }

        $success = $this->departmentModel->create_department($name);

        return $success
            ? ['status' => 'success', 'message' => 'Department created']
            : ['status' => 'fail', 'message' => 'Could not create department'];
    }

    public function update($data) {
        if (!$this->isAdmin()) {
            return ['status' => 'fail', 'message' => 'Admin only'];
        }

        $id = $data['id'] ?? '';
        $name = trim($data['name'] ?? '');

        if (!$id || !$name) {
            return ['status' => 'fail', 'message' => 'ID and name are required'];
        }

        $success = $this->departmentModel->update_department($id, $name);

        return $success
            ? ['status' => 'success', 'message' => 'Department updated']
            : ['status' => 'fail', 'message' => 'Could not update department'];
    }

    public function delete($data) {
        if (!$this->isAdmin()) {
            return ['status' => 'fail', 'message' => 'Admin only'];
        }

        $id = $data['id'] ?? '';

        if (!$id) {
            return ['status' => 'fail', 'message' => 'ID is required'];
        }

        $success = $this->departmentModel->delete_department($id);

        return $success
            ? ['status' => 'success', 'message' => 'Department deleted']
            : ['status' => 'fail', 'message' => 'Could not delete department'];
    }

}
