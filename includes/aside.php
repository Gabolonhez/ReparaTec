<?php
    include 'includes/conexao.php';
    
    $menu = "";
    $selectMenu = "SELECT * FROM menu WHERE menu_acesso IN('$acesso','geral')";
    $resultadoMenu = $conn->query($selectMenu);

    if ($resultadoMenu->num_rows > 0) {
        while ($rowMenu = $resultadoMenu->fetch_assoc()) {
            $nome_do_menu = $rowMenu['menu_nome'];
            $menu .= "<li class='menu-item active'>
                        <a href='#' class='open-dropdown menu-link'>
                            <span class='menu-label'>
                                <span class='menu-name'>".$nome_do_menu."
                                    <span class='menu-arrow'></span>
                                </span>
                            </span>
                            <span class='menu-icon'>
                                <i class='".$rowMenu['menu_icone']."'></i>
                            </span>
                        </a>";
            
            $selectProgramas = "SELECT * FROM programas WHERE programa_menu = '$nome_do_menu' AND programa_acesso IN('$acesso', 'geral')";
            $resultadoProgramas = $conn->query($selectProgramas);
            if ($resultadoProgramas->num_rows > 0) {
                $menu .= "<ul class='sub-menu'>";
                while ($rowProgramas = $resultadoProgramas->fetch_assoc()) {
                    $menu .= "<li class='menu-item'>
                                <a href='".$rowProgramas['programa_link'].".php' class='menu-link'>
                                    <span class='menu-label'>
                                        <span class='menu-name'>".$rowProgramas['programa_nome']."</span>
                                    </span>
                                    <span class='menu-icon'>
                                        <i class='".$rowProgramas['programa_icone']."'></i>
                                    </span>
                                </a>
                              </li>";
                }
                $menu .= "</ul>";
            }
            $menu .= "</li>";
        }
    }
?>
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <img class="admin-brand-logo" src="assets/img/logo.png" width="40" style="border-radius: 10px;">
        <span class="admin-brand-content font-secondary"><a href="index.html">ReparaTec</a></span>
        <div class="ml-auto">
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">
            <?=$menu?>
        </ul>
    </div>
</aside>
