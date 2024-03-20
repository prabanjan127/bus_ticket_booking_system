<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?= $title ?></title>
	<!-- css -->
	<link rel="stylesheet"
		href="<?= base_url('assets/frontend/timepicker') ?>/css/bootstrap-material-datetimepicker.css" />
	<?php $this->load->view('backend/include/base_css'); ?>
</head>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function add_admin() {
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Form validation failed, reload the form
            $this->load->view('backend/add_admin');
        } else {
            // Form validation passed, insert data into the database
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => $this->input->post('level')
            );

            // Insert data into the database
            $this->admin_model->add_admin($data);

            // Redirect to a confirmation page
            redirect('backend/admin_added');
        }
    }

    public function admin_added() {
        $this->load->view('backend/admin_added');
    }

    // Other methods in your controller...
}
?>
<?php

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_admin($data) {
        $this->db->insert('tbl_admin', $data);
    }

    // Other methods in your model...
}
?>
<body id="page-top">
	<!-- navbar -->
	<?php $this->load->view('backend/include/base_nav'); ?>
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<!-- Log on to codeastro.com for more projects -->
		<!-- Basic Card Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Add New Admin</h6>
			</div>
			<div class="card-body">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<form class="user" method="post" action="<?= base_url('backend/confirm') ?>">
								<div class="form-group">
									<input type="text" class="form-control form-control-user" id="exampleFirstName" name="name"
										value="<?= set_value('name') ?>" placeholder="Full Name">
									<?= form_error('name'),'<small class="text-danger pl-3">','</small>'; ?>
								</div>
								<div class="form-group">
									<input type="email" class="form-control form-control-user" placeholder="Email Address" name="email"
										value="<?= set_value('email') ?>">
									<?= form_error('email'),'<small class="text-danger pl-3">','</small>'; ?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control form-control-user" placeholder="Username" name="username"
										value="<?= set_value('username') ?>">
									<?= form_error('username'),'<small class="text-danger pl-3">','</small>'; ?>
								</div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="password" class="form-control form-control-user" name="password"
											placeholder="Password">
									</div>
									<div class="col-sm-6">
										<input type="password" class="form-control form-control-user" name="password2"
											placeholder="Repeat Password">
									</div>
								</div>
								<div class="form-group">
									<select class="form-control" name="level">
										<option value="2">Adminstartor</option>
										<option value="1">Owner</option>
									</select>
								</div>
								<?= form_error('password'),'<small class="text-danger pl-3">','</small>'; ?>
								<a href="<?= base_url('backend/admin')?>" class="btn btn-danger">Go Back</a>
								<button type="submit" class="btn btn-success float-right">
								Add Account
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End of Main Content -->
		<!-- The Modal -->
		<!-- Footer --><!-- Log on to codeastro.com for more projects -->
		<?php $this->load->view('backend/include/base_footer'); ?>
		<!-- End of Footer -->
		<!-- js -->
		<?php $this->load->view('backend/include/base_js'); ?>

		

</body>

</html>
