<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto" style="max-width: 700px;">
                <h5 class="fw-bold mt-5 text-primary">Create User</h5>

                <form action="<?= base_url('user/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username"
                               class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>"
                               value="<?= old('username') ?>" placeholder="Enter username">
                        <?php if (isset($validation) && $validation->hasError('username')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Identifier (Email) -->
                    <div class="mb-3">
                        <label for="identifier" class="form-label">Email</label>
                        <input type="email" id="identifier" name="identifier"
                               class="form-control <?= isset($validation) && $validation->hasError('identifier') ? 'is-invalid' : '' ?>"
                               value="<?= old('identifier') ?>" placeholder="Enter email">
                        <?php if (isset($validation) && $validation->hasError('identifier')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('identifier') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
    <input type="password"
           class="form-control"
           id="floatingPasswordInput"
           name="password"
           inputmode="text"
           autocomplete="new-password"
           placeholder="<?= lang('Auth.password') ?>"
           required>
    <label for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
</div>


                    <!-- Submit -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
