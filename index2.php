<?php
require 'koneksi/koneksi.php';
include 'header.php';
$title_web = "RENTAL MOBIL";

?>

<div class="list">
    <div class="item">
        <?php
        $sql = "SELECT * FROM mobil ORDER BY id_mobil ASC";
        $row = $koneksi->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();
        $no = 1;
        foreach ($hasil as $isi)

        ?>
        <img src="images/1643012563all-new-xenia-exterior-tampak-perspektif-depan - -varian-1.5r-ads.png">
        <div class="introduce">
            <div class="title"><?= $title_web ?></div>
            <div class="topic"><?= $isi['merk'] ?></div>
            <div class="dess">
                <!-- 20 lorem -->
                <strong>
                    <?= $isi['Status'] ?>
                </strong>
            </div>
            <button class="seeMore">DETAIL &#8599</button>
        </div>
        <div class="detail">
            <div class="title"><?= $isi['merk'] ?></div>
            <div class="dess">
                <!-- lorem 50 -->
                <?= $isi['deskripsi'] ?>
            </div>
            <div class="specifications">
                <div>
                    <p>Status</p>
                    <p><?= $isi['status'] ?></p>
                </div>
                <div>
                    <p>Harga</p>
                    <p>Rp. <?= $isi['harga'] ?></p>
                </div>
                <div>
                    <p>Tahun</p>
                    <p>2022</p>
                </div>
                <div>
                    <p>Promo</p>
                    <p>20%</p>
                </div>
                <div>
                    <p>Spesifikasi</p>
                    <p>6 Orang</p>
                </div>
            </div>
            <div class="checkout">
                <button id="kembali">LIHAT MOBIL LAINNYA</button>
                <button>BOOKING NOW!</button>
            </div>
        </div>
    </div>

    <div class="item">
        <img src="images/1643012563all-new-xenia-exterior-tampak-perspektif-depan - -varian-1.5r-ads.png">
        <div class="introduce">
            <div class="title"><?= $title_web ?></div>
            <div class="topic">Airpod</div>
            <div class="dess">
                <!-- 20 lorem -->
                <strong>
                    x

                </strong>
            </div>
            <button class="seeMore">SEE MORE &#8599</button>
        </div>
        <div class="detail">
            <div class="title">Airpod GHTK</div>
            <div class="dess">
                <!-- lorem 50 -->
                <strong>
                    x
                </strong>
            </div>
            <div class="specifications">
                <div>
                    <p>Used Time</p>
                    <p>6 hours</p>
                </div>
                <div>
                    <p>Charging port</p>
                    <p>Type-C</p>
                </div>
                <div>
                    <p>Compatible</p>
                    <p>Android</p>
                </div>
                <div>
                    <p>Bluetooth</p>
                    <p>5.3</p>
                </div>
                <div>
                    <p>Controlled</p>
                    <p>Touch</p>
                </div>
            </div>
            <div class="checkout">
                <button>ADD TO CART</button>
                <button>CHECKOUT</button>
            </div>
        </div>
    </div>

    <div class="item">
        <img src="images/1643012563all-new-xenia-exterior-tampak-perspektif-depan - -varian-1.5r-ads.png">
        <div class="introduce">
            <div class="title"><?= $title_web ?></div>
            <div class="topic">MOBIL</div>
            <div class="dess">
                <!-- 20 lorem -->
                <strong>
                    x
                </strong>
            </div>
            <button class="seeMore">SEE MORE &#8599</button>
        </div>
        <div class="detail">
            <div class="title">Airpod GHTK</div>
            <div class="dess">
                <!-- lorem 50 -->
                x
            </div>
            <div class="specifications">
                <div>
                    <p>Used Time</p>
                    <p>6 hours</p>
                </div>
                <div>
                    <p>Charging port</p>
                    <p>Type-C</p>
                </div>
                <div>
                    <p>Compatible</p>
                    <p>Android</p>
                </div>
                <div>
                    <p>Bluetooth</p>
                    <p>5.3</p>
                </div>
                <div>
                    <p>Controlled</p>
                    <p>Touch</p>
                </div>
            </div>
            <div class="checkout">
                <button>ADD TO CART</button>
                <button>CHECKOUT</button>
            </div>
        </div>
    </div>

    <div class="item">
        <img src="images/1643012563all-new-xenia-exterior-tampak-perspektif-depan - -varian-1.5r-ads.png">
        <div class="introduce">
            <div class="title"><?= $title_web ?></div>
            <div class="topic">Airpod</div>
            <div class="dess">
                <!-- 20 lorem -->
                x
            </div>
            <button class="seeMore">SEE MORE &#8599</button>
        </div>
        <div class="detail">
            <div class="title">Airpod GHTK</div>
            <div class="dess">
                <!-- lorem 50 -->
                x
            </div>
            <div class="specifications">
                <div>
                    <p>Used Time</p>
                    <p>6 hours</p>
                </div>
                <div>
                    <p>Charging port</p>
                    <p>Type-C</p>
                </div>
                <div>
                    <p>Compatible</p>
                    <p>Android</p>
                </div>
                <div>
                    <p>Bluetooth</p>
                    <p>5.3</p>
                </div>
                <div>
                    <p>Controlled</p>
                    <p>Touch</p>
                </div>
            </div>
            <div class="checkout">
                <button>ADD TO CART</button>
                <button>CHECKOUT</button>
            </div>
        </div>
    </div>

    <div class="item">
        <img src="images/img5.png">
        <div class="introduce">
            <div class="title"><?= $title_web ?></div>
            <div class="topic">Airpod</div>
            <div class="dess">
                <!-- 20 lorem -->
                x
            </div>
            <button class="seeMore">SEE MORE &#8599</button>
        </div>
        <div class="detail">
            <div class="title">Airpod</div>
            <div class="dess">
                <!-- lorem 50 -->
                x
            </div>
            <div class="specifications">
                <div>
                    <p>Used Time</p>
                    <p>6 hours</p>
                </div>
                <div>
                    <p>Charging port</p>
                    <p>Type-C</p>
                </div>
                <div>
                    <p>Compatible</p>
                    <p>Android</p>
                </div>
                <div>
                    <p>Bluetooth</p>
                    <p>5.3</p>
                </div>
                <div>
                    <p>Controlled</p>
                    <p>Touch</p>
                </div>
            </div>
            <div class="checkout">
                <button>ADD TO CART</button>
                <button>CHECKOUT</button>
            </div>
        </div>
    </div>

    <div class="item">
        <img src="images/img6.png">
        <div class="introduce">
            <div class="title"><?= $title_web ?></div>
            <div class="topic">Airpod</div>
            <div class="dess">
                <!-- 20 lorem -->
                x
            </div>
            <button class="seeMore">SEE MORE &#8599</button>
        </div>
        <div class="detail">
            <div class="title">Airpod GHTK</div>
            <div class="dess">
                <!-- lorem 50 -->
                x
            </div>
            <div class="specifications">
                <div>
                    <p>Used Time</p>
                    <p>6 hours</p>
                </div>
                <div>
                    <p>Charging port</p>
                    <p>Type-C</p>
                </div>
                <div>
                    <p>Compatible</p>
                    <p>Android</p>
                </div>
                <div>
                    <p>Bluetooth</p>
                    <p>5.3</p>
                </div>
                <div>
                    <p>Controlled</p>
                    <p>Touch</p>
                </div>
            </div>
            <div class="checkout">
                <button>ADD TO CART</button>
                <button>CHECKOUT</button>
            </div>
        </div>
    </div>
</div>
<div class="arrows">
    <button id="prev">
        <
            </button>
            <button id="next">></button>
            <button id="back">See All &#8599</button>
</div>
<?php $no++;
?>
<?php include 'footer.php'; ?>
<script>
    let kembaliButton = document.getElementById('kembali');
    kembaliButton.onclick = function() {
        carousel.classList.remove('showDetail');
    }
</script>