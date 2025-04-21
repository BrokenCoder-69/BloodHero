
document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();
  

  
    const data = {
      login: document.getElementById('login').value,
      password: document.getElementById('loginPassword').value
    };
  
    try {
      const response = await fetch('http://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(data)
      });
  
      const result = await response.json();
  
      if (response.ok) {
        alert('Login successful!');
        localStorage.setItem('token', result.token);
        window.location.href = './Dashboards/user.html';
      } else {
        const errorMsg = result?.message || Object.values(result.errors || {}).join(', ') || 'Unknown error';
        alert('Login failed: ' + errorMsg);
      }
    } catch (error) {
      alert('Error: ' + error.message);
    }
  });
  