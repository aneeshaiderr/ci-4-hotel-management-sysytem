<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow">
            <div class="card-body p-4">

                <h2 class="text-center mb-4 fw-bold text-primary">Signup</h2>

                <!-- Success Flash Message -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Validation Errors -->
                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger p-2">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <p class="mb-1"><?= esc($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('signup') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Username -->
                    <div class="mb-3">
                        <input type="text" name="username"
                               class="form-control"
                               placeholder="Username"
                               value="<?= old('username') ?>" required>
                    </div>

                    <!-- First Name -->
                    <div class="mb-3">
                        <input type="text" name="first_name"
                               class="form-control"
                               placeholder="First Name"
                               value="<?= old('first_name') ?>" required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <input type="text" name="last_name"
                               class="form-control"
                               placeholder="Last Name"
                               value="<?= old('last_name') ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <input type="email" name="email"
                               class="form-control"
                               placeholder="Email"
                               value="<?= old('email') ?>" required>
                    </div>

                    <!-- Contact Number -->
                    <div class="mb-3">
                        <input type="text" name="contact_no"
                               class="form-control"
                               placeholder="Contact Number"
                               value="<?= old('contact_no') ?>" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Password" required>
                    </div>

                    <button type="submit"
                            class="btn btn-primary w-100 fw-bold">
                        Signup
                    </button>
                </form>
            </div>

            <div class="card-footer text-center bg-light">
                Already have an account?
                <a href="<?= base_url('login') ?>">Login</a>
            </div>
        </div>
    </div>
</div>
