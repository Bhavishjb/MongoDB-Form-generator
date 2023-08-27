<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

	<div>
		<h1>User lists</h1>

		<div>
			<a href="<?php echo base_url('/usercontroller/create'); ?>" class="btn btn-success mt-4 mb-4"><i class="fas fa-plus"> </i> Create User</a>
		</div>

		<div id="body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Gender</th>
						<th scope="col">Mobile</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($users)) : ?>
						<?php foreach ($users as $user) : ?>
							<tr class="table-light">
								<td><?php echo isset($user->name) ? $user->name : 'N/A'; ?></td>
								<td><?php echo isset($user->email) ? $user->email : 'N/A'; ?></td>
								<td><?php echo isset($user->gender) ? $user->gender : 'N/A'; ?></td>
								<td><?php echo isset($user->mobile) ? $user->mobile : 'N/A'; ?></td>
								<td>
									<a href="<?= site_url('/usercontroller/update/' . $user->_id) ?>" class="btn btn-info"><i class="fas fa-edit"> </i> Update</a>
									<a href="<?= site_url('/usercontroller/delete/' . $user->_id) ?>" class="btn btn-danger" onclick="return confirm('Do you want to delete this record?')"><i class="fas fa-trash-alt"> </i> Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5">No records found.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

</body>

</html>