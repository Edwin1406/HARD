<div id="auth">

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html"><img src="" alt="">MEGASTOCK</a>
                </div>
                <h1 class="auth-title">Acceso.</h1>
                <p class="auth-subtitle mb-5">Inicie sesión con los datos que ingresó durante el registro.</p>

                <form action="/" method="POST">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="email">Email:</label>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            class="form-control form-control-xl"
                            placeholder="email">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="password">Password:</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control form-control-xl"
                            placeholder="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            Mantenerme conectado
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Iniciar Sesión</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">¿No tienes una cuenta? <a href="#"
                            class="font-bold">Regístrate</a>.</p>
                    <p><a class="font-bold" href="#">¿Olvidaste tu contraseña?</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>