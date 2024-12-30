<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD with Modal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
         #navabr {
            font-size: 34px;
        }
    </style>
</head>
<body>
    <?php include('db1.php'); ?>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" id="navabr">PHP CAWM </a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container mt-5">
        <h2 class="text-center" style="color: red;"  >PHP CRUD Application with Modal</h2>

        <!-- Success Alerts -->
        <?php if (isset($_GET['success_add']) && $_GET['success_add'] == 'true'): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3 text-center" role="alert">
                Your information has been added successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (isset($_GET['success_edit']) && $_GET['success_edit'] == 'true'): ?>
            <div class="alert alert-info alert-dismissible fade show mt-3 text-center" role="alert">
                Your information has been updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (isset($_GET['success_delete']) && $_GET['success_delete'] == 'true'): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3 text-center" role="alert">
                User has been deleted successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New User</button>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM users ORDER BY id DESC";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id']}' data-name='{$row['name']}' data-email='{$row['email']}' data-phone='{$row['phone']}'>Edit</button>
                                    <a href='delete_user.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No Data Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="add_user.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit_user.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="edit-phone" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white pt-5 pb-4  mt-5">
  <div class="container text-center text-md-left">
    <div class="row text-center text-md-left">
      
      <!-- About Section -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">About Us</h5>
        <p>
          We are dedicated to providing high-quality services. Follow us on our social channels for updates.
        </p>
      </div>

      <!-- Links Section -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Links</h5>
        <p>
          <a href="#home" class="text-white" style="text-decoration: none;">Home</a>
        </p>
        <p>
          <a href="#about" class="text-white" style="text-decoration: none;">About</a>
        </p>
        <p>
          <a href="#services" class="text-white" style="text-decoration: none;">Services</a>
        </p>
        <p>
          <a href="#contact" class="text-white" style="text-decoration: none;">Contact</a>
        </p>
      </div>

      <!-- Contact Section -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
        <p>
          <i class="fas fa-home mr-3"></i> Sialkot, Pakistan
        </p>
        <p>
          <i class="fas fa-envelope mr-3"></i> muhammadbilal036356@gmail.com
        </p>
        <p>
          <i class="fas fa-phone mr-3"></i> +92 307 9599169
        </p>
      </div>

      <!-- Social Section -->
      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Follow Us</h5>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-facebook fa-lg mr-4"></i>
        </a>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-twitter fa-lg mr-4"></i>
        </a>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-instagram fa-lg mr-4"></i>
        </a>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-linkedin fa-lg mr-4"></i>
        </a>
      </div>
    </div>

    <hr class="mb-4" />

    <!-- Copyright Section -->
    <div class="row align-items-center">
      <div class="col-md-7 col-lg-8">
        <p class="text-white">
          © 2024 Crud Application | All rights reserved
        </p>
      </div>
      <div class="col-md-5 col-lg-4">
        <p class="text-white text-md-right">
          Developed by <span class="text-warning">Muhammad Bilal</span>
        </p>
      </div>
    </div>
  </div>
</footer>
    <script>
        // Fill edit form with data from table
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const phone = this.getAttribute('data-phone');

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-phone').value = phone;
            });
        });
    </script>
</body>
</html>
