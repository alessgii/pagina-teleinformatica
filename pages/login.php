<?php
if (!defined('BASE_URL')) {
    @include_once __DIR__ . '/../config/config.php';
}
?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Iniciar Sesión</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/'; ?>public/img/favicon.ico" />
		<link rel="stylesheet" href="<?php echo defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/'; ?>public/css/tailwind/output.css?v=<?php echo time(); ?>" />
	</head>
	<body class="m-0 p-0">
		<div class="min-h-screen w-full flex justify-center items-center bg-white relative overflow-x-hidden overflow-y-auto p-4 py-8 box-border" style="min-height: 100vh; width: 100%; position: relative; background-color: #ffffff; box-sizing: border-box;">
			<div 
				class="absolute inset-0 z-0 pointer-events-none" 
				style="position: absolute; inset: 0; z-index: 0; pointer-events: none; background-image: radial-gradient(circle at center, rgba(0, 174, 204, 0.45) 0%, rgba(0, 174, 204, 0.15) 40%, transparent 70%);"
			></div>

			<div class="relative z-10 p-5 sm:p-6 w-full max-w-95 bg-white rounded-3xl space-y-3 shadow-sm mx-auto box-border" style="max-width: 380px; box-sizing: border-box;">
				<img src="<?php echo defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/'; ?>public/img/auth/intel-logo.svg" alt="Logo INTEL" class="h-10 w-auto" />

				<h1 class="text-2xl sm:text-[32px] font-extrabold text-gray-900">Iniciar Sesión</h1>

				<form id="login-form" class="space-y-4">
					<div class="flex flex-col gap-1">
						<label for="email" class="font-medium text-sm text-gray-900">Correo Institucional*</label>
						<div class="relative flex items-center w-full">
							<span class="absolute left-3.5 pointer-events-none text-gray-400 flex items-center">
								<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M21.75 6.75V17.25C21.75 18.4926 20.7426 19.5 19.5 19.5H4.5C3.25736 19.5 2.25 18.4926 2.25 17.25V6.75M21.75 6.75C21.75 5.50736 20.7426 4.5 19.5 4.5H4.5C3.25736 4.5 2.25 5.50736 2.25 6.75M21.75 6.75V6.99271C21.75 7.77405 21.3447 8.49945 20.6792 8.90894L13.1792 13.5243C12.4561 13.9694 11.5439 13.9694 10.8208 13.5243L3.32078 8.90894C2.65535 8.49945 2.25 7.77405 2.25 6.99271V6.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</span>
							<input type="email" id="email" name="institutional_email" class="w-full min-w-0 box-border pl-11 pr-3 py-3 rounded-xl text-base border-2 border-gray-300 font-medium placeholder:text-gray-400 outline-none focus:bg-blue-50 shadow-[0_4px_0_var(--color-gray-300)]" placeholder="EJ. ash.ketchum@alumnos.udg.mx" required />
						</div>
					</div>

					<div class="flex flex-col gap-1">
						<label for="password" class="font-medium text-sm text-gray-900">Contraseña*</label>
						<div class="relative flex items-center w-full">
							<span class="absolute left-3.5 pointer-events-none text-gray-400 flex items-center">
								<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M16.5 10.5V6.75C16.5 4.26472 14.4853 2.25 12 2.25C9.51472 2.25 7.5 4.26472 7.5 6.75V10.5M6.75 21.75H17.25C18.4926 21.75 19.5 20.7426 19.5 19.5V12.75C19.5 11.5074 18.4926 10.5 17.25 10.5H6.75C5.50736 10.5 4.5 11.5074 4.5 12.75V19.5C4.5 20.7426 5.50736 21.75 6.75 21.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</span>
							<input type="password" id="password" name="password" class="w-full min-w-0 box-border pl-11 pr-11 py-3 rounded-xl text-base border-2 border-gray-300 font-medium placeholder:text-gray-400 outline-none focus:bg-blue-50 shadow-[0_4px_0_var(--color-gray-300)]" placeholder="••••••••" required />
							<button type="button" id="toggle-password-btn" class="absolute right-3.5 text-gray-400 hover:text-gray-600 cursor-pointer flex items-center focus:outline-none border-none bg-transparent" aria-label="Mostrar u ocultar contraseña">
								<svg id="eye-icon" class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M2.0355 12.3224C1.96642 12.1151 1.96635 11.8907 2.03531 11.6834C3.42368 7.50972 7.36074 4.5 12.0008 4.5C16.6386 4.5 20.5742 7.50692 21.9643 11.6776C22.0334 11.8849 22.0334 12.1093 21.9645 12.3166C20.5761 16.4903 16.639 19.5 11.999 19.5C7.36115 19.5 3.42559 16.4931 2.0355 12.3224Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M15 12C15 13.6569 13.6568 15 12 15C10.3431 15 8.99995 13.6569 8.99995 12C8.99995 10.3431 10.3431 9 12 9C13.6568 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<svg id="eye-slash-icon" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M3.9799 8.22257C3.05679 9.31382 2.35239 10.596 1.93433 12.0015C3.22562 16.338 7.24308 19.5 11.9991 19.5C12.9916 19.5 13.952 19.3623 14.8622 19.1049M6.2276 6.22763C7.88385 5.13558 9.86768 4.5 11.9999 4.5C16.7559 4.5 20.7734 7.66205 22.0647 11.9985C21.3528 14.3919 19.8105 16.4277 17.772 17.772M6.2276 6.22763L2.99997 3M6.2276 6.22763L9.87865 9.87868M17.772 17.772L21 21M9.87865 9.87868L14.1213 14.1213L17.772 17.772M14.1213 14.1213C14.6642 13.5784 15 12.8284 15 12C15 10.3431 13.6568 9 12 9C11.1715 9 10.4215 9.33579 9.87865 9.87868" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
						</div>
					</div>

					<div class="flex justify-end mt-6">
						<button type="submit" id="submit-btn" class="bg-[#BEF264] text-base py-2 px-6 rounded-[28px] border-2 border-lime-500 font-extrabold cursor-pointer shadow-[0_4px_0_#A3E635] text-gray-800 transition-all duration-75 active:translate-y-1 active:shadow-none">¡Vamos!</button>
					</div>
				</form>

				<div class="text-center text-zinc-900 text-xs mt-5">
					<p>¿No tienes cuenta? <a href="<?php echo defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/'; ?>register" class="font-bold underline text-zinc-900">Regístrate aquí</a></p>
				</div>

				<div id="error-message" style="display: none" class="text-xs text-center text-red-500 font-medium"></div>
			</div>
		</div>

		<script>
			const loginForm = document.getElementById("login-form");
			const errorMessage = document.getElementById("error-message");
			const submitBtn = document.getElementById("submit-btn");
			const togglePasswordBtn = document.getElementById("toggle-password-btn");
			const passwordInput = document.getElementById("password");
			const eyeIcon = document.getElementById("eye-icon");
			const eyeSlashIcon = document.getElementById("eye-slash-icon");

			if (togglePasswordBtn && passwordInput) {
				togglePasswordBtn.addEventListener("click", () => {
					const isPassword = passwordInput.type === "password";
					passwordInput.type = isPassword ? "text" : "password";
					eyeIcon.classList.toggle("hidden", isPassword);
					eyeSlashIcon.classList.toggle("hidden", !isPassword);
				});
			}

			loginForm.addEventListener("submit", async (e) => {
				e.preventDefault();

				errorMessage.style.display = "none";
				errorMessage.textContent = "";
				submitBtn.disabled = true;

				const institutional_email = document
					.getElementById("email")
					.value.trim();
				const password = document.getElementById("password").value;

				const baseUrl = "<?php echo defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/'; ?>";

				try {
					const response = await fetch(`${baseUrl}api/login`, {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
						},
						credentials: "same-origin",
						body: JSON.stringify({
							institutional_email: institutional_email,
							password: password,
						}),
					});

					const result = await response.json();

					if (response.ok && result.success) {
						window.location.href = `${baseUrl}inicio`;
					} else {
						errorMessage.textContent =
							result.message || "Error al iniciar sesión.";
						errorMessage.style.display = "block";
					}
				} catch (error) {
					errorMessage.textContent =
						"Hubo un problema de conexión con el servidor.";
					errorMessage.style.display = "block";
				} finally {
					submitBtn.disabled = false;
				}
			});
		</script>
	</body>
</html>
