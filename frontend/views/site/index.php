<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="site-index">
  <section id="hero">
    <div class="hero-container">
      <h1>Welcome to System</h1>
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fa fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>
      <h2>Sistem Untuk Memprediksi Kondisi Tanaman Cabai<br> Berdasarkan Keadaan Lingkungan</h2>
      <a href="<?= Url::to(['tanaman/index']) ?>" class="btn-get-started">Lihat Tanaman <i class="fa fa-eye"></i></a>
    </div>
  </section>

  <section id="services">
    <div class="container wow fadeIn">
      <div class="section-header">
        <h3 class="section-title">Services</h3>
        <div class="divider-custom divider">
          <div class="divider-custom-line"></div>
          <div class="divider-custom-icon">
            <i class="fa fa-star"></i>
          </div>
          <div class="divider-custom-line"></div>
        </div>
        <br><br>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
          <div class="box">
            <div class="icon"><i class="fa fa-desktop"></i></div>
            <h4 class="title" style="color:#333;">Cepat</h4>
            <p class="description">Data yang dikumpulkan dilakukan secara real time dengan pengambilan data oleh sensor</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
          <div class="box">
            <div class="icon"><i class="fa fa-bar-chart"></i></div>
            <h4 class="title" style="color:#333;">Lengkap</h4>
            <p class="description">Data yang dikumpulkan lengkap dengan pembagian berdasarkan 5 zona waktu</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
          <div class="box">
            <div class="icon"><i class="fa fa-paper-plane"></i></div>
            <h4 class="title" style="color:#333;">Akurasi</h4>
            <p class="description">Data yang dikumpulkan memiliki akurasi tinggi dengan sensor dan perangkat Internet of Things yang digunakan</p>
          </div>
        </div>
      </div>

    </div>
  </section><!-- #services -->

  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>TA01-1924-01</strong>. All Rights Reserved
      </div>
      <div class="credits">

      </div>
    </div>
  </footer>
</div>