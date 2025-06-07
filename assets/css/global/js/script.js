document.addEventListener("DOMContentLoaded", () => {
    const isLoginPage = window.location.pathname.includes("login");

    if (isLoginPage) {
        // LOGIN
        const loginButton = document.querySelector("#login-button");
        loginButton.addEventListener("click", () => {
            const email = document.querySelector('input[placeholder="E-mail"]').value;
            const password = document.querySelector('input[placeholder="Senha"]').value;

            const storedUser = JSON.parse(localStorage.getItem("verboUser"));

            if (storedUser && storedUser.email === email && storedUser.password === password) {
                alert(`Login realizado com sucesso! Bem-vindo(a), ${storedUser.nome}`);
                // Redirecionar após login bem-sucedido (opcional)
                // window.location.href = "../index/index.html";
            } else {
                alert("E-mail ou senha inválidos!");
            }
        });
    } else {
        // CADASTRO
        const registerButton = document.querySelector(".login-button");
        registerButton.addEventListener("click", () => {
            const nome = document.querySelector('input[placeholder="nome"]').value;
            const email = document.querySelector('input[placeholder="E-mail"]').value;
            const password = document.querySelector('input[placeholder="Senha"]').value;

            if (!nome || !email || !password) {
                alert("Preencha todos os campos!");
                return;
            }

            const user = { nome, email, password };
            localStorage.setItem("verboUser", JSON.stringify(user));
            alert("Cadastro realizado com sucesso!");
            window.location.href = "../login/login.html";
        });
    }
});
// Cadastro de usuário
document.addEventListener('DOMContentLoaded', () => {
    const cadastroBtn = document.querySelector('#cadastro-btn');
    const loginBtn = document.querySelector('#login-btn');

    if (cadastroBtn) {
        cadastroBtn.addEventListener('click', () => {
            const nome = document.querySelector('#nomecompleto').value;
            const email = document.querySelector('#email').value;
            const senha = document.querySelector('#senha').value;

            if (nome && email && senha) {
                const usuario = { nome, email, senha };
                localStorage.setItem('usuario', JSON.stringify(usuario));
                alert('Cadastro realizado com sucesso!');
                window.location.href = '../login/login.html';
            } else {
                alert('Preencha todos os campos.');
            }
        });
    }

    if (loginBtn) {
        loginBtn.addEventListener('click', () => {
            const email = document.querySelector('#email').value;
            const senha = document.querySelector('#senha').value;
            const usuarioSalvo = JSON.parse(localStorage.getItem('usuario'));

            if (usuarioSalvo && email === usuarioSalvo.email && senha === usuarioSalvo.senha) {
                alert(`Login realizado com sucesso, ${usuarioSalvo.nome}!`);
                localStorage.setItem('logado', 'true');
                window.location.href = '/pages/bemvindo.html';
            } else {
                alert('Email ou senha inválidos.');
            }
        });
    }
});

// link esqueci minha senha (envio do link  para o email  para redefinir)
  document.addEventListener('DOMContentLoaded', () => {
    const forgotLink = document.getElementById('forgot-link');
    forgotLink.addEventListener('click', (e) => {
      e.preventDefault(); // evita o comportamento padrão do link
      alert('Um link para redefinir a senha foi enviado para o seu e-mail, caso ele esteja cadastrado em nosso sistema.');
    });
  });
