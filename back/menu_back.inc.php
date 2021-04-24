<ul class="menu">
    <li>
        <a href="eleves.php">
            <span class="material-icons">group</span>
            <p>Élèves</p>
        </a>
    </li>
    <?php if($_SESSION['droits'] == "Admin"): ?>
        <li>
            <a href="upload.php">
                <span class="material-icons">upload</span>
                <p>Uploader images</p>
            </a>
        </li>
        <li>
            <a href="users.php">
                <span class="material-icons">account_circle</span>
                <p>Comptes utilisateurs</p>
            </a>
        </li>
    <?php endif; ?>
    <li>
        <a href="logout.php">
            <span class="material-icons">logout</span>
            <p>Déconnexion</p>
        </a>
    </li>
</ul>