<h1>Novo Usuário</h1>

<form action="user-new.php" method="POST" class="form-usuario">

    <div class="campo">
        <label for="usuario">Usuário</label>
        <input type="text" name="usuario" id="usuario" required>
    </div>

    <div class="campo">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required>
    </div>

    <div class="campo">
        <label for="senha1">Senha</label>
        <input type="password" name="senha1" id="senha1" required>
    </div>

    <div class="campo">
        <label for="senha2">Repita a Senha</label>
        <input type="password" name="senha2" id="senha2" required>
    </div>

    <div class="campo">
        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo">
            <option value="admin">Administrador do Sistema</option>
            <option value="editor">Editor do Sistema</option>
        </select>
    </div>

    <button type="submit">Adicionar</button>

</form>