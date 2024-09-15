<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="font-['Montserrat']">
    @yield('content')
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
  // Target the first password input and toggle icon
  const passwordInput1 = document.getElementById("password1");
  const passwordToggle1 = document.getElementById("password-toggle1");

  passwordToggle1.addEventListener("click", () => {
    if (passwordInput1.type === "password") {
      passwordInput1.type = "text";
      passwordToggle1.name = "eye-outline";
    } else {
      passwordInput1.type = "password";
      passwordToggle1.name = "eye-off-outline";
    }
  });

  // Target the second (confirm password) input and toggle icon (similar logic)
  const confirmPasswordInput = document.getElementById("confirm-password");
  const confirmPasswordToggle = document.getElementById("password-toggle2");

  confirmPasswordToggle.addEventListener("click", () => {
    if (confirmPasswordInput.type === "password") {
      confirmPasswordInput.type = "text";
      confirmPasswordToggle.name   
 = "eye-outline";
    } else {
      confirmPasswordInput.type = "password";
      confirmPasswordToggle.name = "eye-off-outline";
    }
  });
</script>
</html>
