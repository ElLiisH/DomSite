const registerForm = document.getElementById('register-form');

registerForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;

  if (name && email && password && confirmPassword) {
    if (password === confirmPassword) {
      fetch('dbconn.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email, password }),
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            alert('Registered successfully!');
          } else {
            alert('Registration failed. Please try again.');
          }
        })
        .catch((err) => console.error(err));
    } else {
      alert('Passwords do not match!');
    }
  } else {
    alert('Please fill in all fields!');
  }
});
