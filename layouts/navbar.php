<header>
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="?user=home"><img src="../public/assets/images/logo/logo-ptsos.png" alt="Logo"
                        style="height: 4rem; width: 8rem;" /></a>
            </div>
            <div class="header-top-right">
                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown"
                        class="user-dropdown d-flex align-items-center dropend dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <?php
                            $id = $_SESSION['id_users'] ?? '';
                            $select_users = $conn->prepare("SELECT * FROM `users` WHERE id_users = ?");
                            $select_users->execute([$id]);
                            if($select_users->rowCount() > 0){
                                while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                                    $photo = $fetch_users['photo'];
                            ?>
                            <?php  
                                if(!empty($photo)){
                            ?>
                            <img src="../uploaded_profile/<?= $fetch_users['photo']; ?>" alt="Avatar" />
                            <?php }else{ ?>
                            <img src="../public/assets/images/faces/9.png" alt="Avatar" />
                            <?php
                            }
                            }
                            }
                        ?>
                        </div>
                        <div class="text">
                            <h6 class="user-dropdown-name"><?php echo $_SESSION['first_name']; ?>
                                <?php echo $_SESSION['last_name']; ?></h6>
                            <p class="user-dropdown-status text-sm text-muted">
                                <?php echo $_SESSION['position']; ?>
                            </p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        <li><a class="dropdown-item" href="?user=profile">My Account</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <ul class="justify-content-center">
                <li class="menu-item">
                    <a href="?user=home" class="menu-link">
                        <span><i class="bi bi-house-door-fill" style="margin-right:0.5rem;"></i>Home</span>
                    </a>
                </li>

                <li class="menu-item has-sub">
                    <a href="#" class="menu-link">
                        <span><i class="bi bi-grid-fill"></i>
                            Courses</span>
                    </a>
                    <div class="submenu">
                        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <?php
                                    $select_category = $conn->prepare("SELECT * FROM `category`");
                                    $select_category->execute();
                                    if($select_category->rowCount() > 0){
                                        while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){
                                            $id_category = $fetch_category['id_category'];
                                ?>
                                <li class="submenu-item has-sub">

                                    <a href="#" class="submenu-link"><?= $fetch_category['name']; ?></a>

                                    <!-- 3 Level Submenu -->
                                    <ul class="subsubmenu">
                                        <?php
                                            $select_sub_category = $conn->prepare("SELECT * FROM `sub_category` WHERE id_category = ?");
                                            $select_sub_category->execute([$id_category]);
                                            if($select_sub_category->rowCount() > 0){
                                                while($fetch_sub_category = $select_sub_category->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <li class="subsubmenu-item">
                                            <a href="?user=categories&get_id_sub=<?= $fetch_sub_category['id_sub_category']; ?>"
                                                class="subsubmenu-link"><?= $fetch_sub_category['name_sub']; ?></a>
                                        </li>
                                        <?php
                                        }
                                        }
                                    ?>
                                    </ul>
                                </li>

                                <?php
                                        }
                                        }
                                    ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu-item">
                    <a href="?user=mycourse" class="menu-link">
                        <span><i class="bi bi-bookmark-fill"></i> My Courses</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>