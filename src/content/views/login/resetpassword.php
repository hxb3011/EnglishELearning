<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body {
        background-color: burlywood;
    }
</style>
<div class="container vh-lg-100 mt-sm-5 bg-soft d-flex justify-content-center align-items-center">
    <div class="row justify-content-center form-bg-image">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                <h1 class="h3 mb-4 text-center">Reset password</h1>
                <form action="#">
                    <!-- Form -->
                    <div class="form-group mb-4">
                        <label for="password">Your Password</label>
                        <div class="input-group">
                            <input type="password" placeholder="Password" class="form-control" id="password" required>
                        </div>
                    </div>
                    <!-- End of Form -->
                    <!-- Form -->
                    <div class="form-group mb-4">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" placeholder="Confirm Password" class="form-control" id="confirm_password" required>
                        </div>
                    </div>
                    <!-- End of Form -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>