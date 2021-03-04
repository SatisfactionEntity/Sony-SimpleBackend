<?php
$this->WriteInc('Header');
?>
<div class="row">
    <div class="col-sm-4">
        <div class="box">
            <h2 class="green">Gokbond</h2>
            <div class="inner">
                <p>
                    <img style="float:right;margin:10px 5px 10px 20px;width:50px;" src="/Simple/Assets/img/gamble.png"/>Het
                    Gokbond verzorgt alles dat betrekking heeft tot de gokwereld. Leden van het Gokbond weten alles over
                    de rares binnen <?= CMS::$Config['cms']['hotelname'] ?>. Daarnaast zijn ze te vertrouwen en staan ze altijd open om te palen,
                    waardoor het gokken veiliger verloopt. Tevens houden ze de ruilwaarde up-to-date én kan je met al je
                    vragen betreft rare’s en/of gokken terecht bij de leden. <?= CMS::$Config['cms']['hotelname'] ?> gokteam zoekt nog leden solliciteer snel voor 1 van deze functies.</p>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <?php
        $Data = '';
        $Players = CMS::$MySql->query('SELECT username,look,last_online,motto,online,rank FROM users WHERE rank in (22,20) ORDER BY rank DESC');
        $Ranks = CMS::$MySql->query('SELECT id,rank_name,color FROM permissions WHERE id in (22,20) ORDER BY id DESC');
        if (is_array($Ranks))
        {
            foreach ($Ranks as $Row) {
                $found = false;
                $Data .= '<div class="box"><h2 class="' . $Row['color'] . '">' . $Row['rank_name'] . '</h2>';
                if (is_array($Players)) {
                    foreach ($Players as $Player) {
                        if ($Player['rank'] == $Row['id']) {
                            $found = true;
                            $Data .= '<div class="staffBox"><img style="margin-bottom:4px;margin-left:4px;position:absolute" src="'.CMS::$Config['cms']['avatarlocation'].'?figure=' . $Player['look'] . '&head_direction=3&headonly=true&gesture=sml"><span class="status"><img src="/Simple/Assets/img/' . ($Player['online'] == "1" ? 'online' : 'offline') . '.gif"></span><table style="margin-left:60px;padding-top:6px"><tr style="padding:0"><td><strong><a href="/home/' . $Player['username'] . '">' . $Player['username'] . '</a></strong><br>' . htmlspecialchars($Player['motto']) . '<br>Laatst online: ' . date('d-m-Y H:i:s', $Player['last_online']) . '</td></tr></table></div>';
                        }
                    }
                }
                if (!$found) {
                    $Data .= '<div class="inner">'.str_ireplace("%rank%", $Row['rank_name'], CMS::$Lang['ranknotfound']).'</div>';
                }
                $Data .= '</div>';
            }
        }
        else
        {
            $Data .= '<div class="col-sm-7"><div class="box"><h2 class="red">'.CMS::$Lang['noranksfound'].'</h2><div class="inner">'.CMS::$Lang['noranksfound2'].'</div></div></div>';
        }
        echo $Data;
        ?>
    </div>
</div>
<script type="text/javascript" src="/Simple/Assets/js/global/script.js"></script>
<?php
$this->WriteInc('Footer');
?>
