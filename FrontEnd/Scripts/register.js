
document.getElementById('registrationForm').addEventListener('submit', async function (e) {
  e.preventDefault();

  const password = document.getElementById('regPassword').value;
  const confirmPassword = document.getElementById('regConfirmPassword').value;

  if (password !== confirmPassword) {
    alert('Passwords do not match!');
    return;
  }

  const data = {
    name: document.getElementById('regName').value,
    email: document.getElementById('regEmail').value,
    phone: document.getElementById('regPhone').value,
    city: document.getElementById('regCity').value,
    address: document.getElementById('regAddress').value,
    blood_group: document.getElementById('bloodGroup').value,
    experience: document.querySelector('input[name="donorStatus"]:checked')?.value,
    password: password,
    password_confirmation: confirmPassword
  };

  try {
    const response = await fetch('http://127.0.0.1:8000/api/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(data)
    });

    const result = await response.json();

    if (response.ok) {
      alert('Registration successful!');
      window.location.href = 'login.html';
    } else {
      const errorMsg = result?.message || Object.values(result.errors || {}).join(', ') || 'Unknown error';
      alert('Registration failed: ' + errorMsg);
    }
  } catch (error) {
    alert('Error: ' + error.message);
  }
});
