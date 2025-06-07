// Função para salvar novo usuário no localStorage
function registerUser(name, email, password) {
    const users = JSON.parse(localStorage.getItem("users")) || [];

    // Verifica se já existe o e-mail
    if (users.find(user => user.email === email)) {
        alert("Este e-mail já está cadastrado.");
        return false;
    }

    users.push({ name, email, password });
    localStorage.setItem("users", JSON.stringify(users));
    alert("Cadastro realizado com sucesso!");
    window.location.href = "../login/login.html";
    return true;
}

// Função para fazer login do usuário
function loginUser(email, password) {
    const users = JSON.parse(localStorage.getItem("users")) || [];
    const user = users.find(user => user.email === email && user.password === password);

    if (user) {
        localStorage.setItem("loggedInUser", JSON.stringify(user));
        alert(`Login bem-sucedido! Bem-vindo(a), ${user.name}`);
        window.location.href = "../index/index.html"; // redireciona à home
    } else {
        alert("Email ou senha incorretos.");
    }
}
