<?php
    require APPROOT . '/views/includes/head.php';
?>

<body>
    <div id="section-landing">
        <?php
        require APPROOT . '/views/includes/nav.php';
    ?>
        <div id="results">
            <div class="results-sidebar">
                <div class="result-list">
                    <ul>
                        <li>Fronend Developers</li>
                        <ul>
                            <li>
                                Angular (<?php echo $data['counter']['angular'] ?>)
                            </li>
                            <ul>
                                <li>
                                    AngularJs (<?php echo $data['counter']['angularjs'] ?>)
                                </li>
                            </ul>
                            <li>
                                React (<?php echo $data['counter']['react'] ?>)
                            </li>
                            <ul>
                                <li>
                                    React Native (<?php echo $data['counter']['reactNative'] ?>)
                                </li>
                            </ul>
                            <li>
                                Vue (<?php echo $data['counter']['vue'] ?>)
                            </li>
                        </ul>

                        <li>Backend Developers</li>
                        <ul>
                            <li>
                                PHP (<?php echo $data['counter']['php'] ?>)
                            </li>
                            <ul>
                                <li>
                                    Symfony (<?php echo $data['counter']['symfony'] ?>)
                                </li>
                                <li>
                                    Silex (<?php echo $data['counter']['silex'] ?>)
                                </li>
                                <li>
                                    Laravel (<?php echo $data['counter']['laravel'] ?>)
                                </li>
                                <li>
                                    Lumen (<?php echo $data['counter']['lumen'] ?>)
                                </li>
                            </ul>
                            <li>
                                NodeJs (<?php echo $data['counter']['nodejs'] ?>)
                            </li>
                            <ul>
                                <li>
                                    Express (<?php echo $data['counter']['express'] ?>)
                                </li>
                                <li>
                                    NestJs (<?php echo $data['counter']['nestjs'] ?>)
                                </li>
                            </ul>
                        </ul>
                    </ul>
                </div>
            </div>
            <div class="results-main">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Subtypes</th>
                    </tr>
                    <?php
                        foreach ($data['users'] as  $user) {
                            echo '<tr>';
                            echo '<td>'.$user['name'].'</td>';
                            echo '<td>'.$user['email'].'</td>';
                            echo '<td>'.strtoupper($user['type']).'</td>';
                            echo '<td>'.strtoupper($user['subtype']).'</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>