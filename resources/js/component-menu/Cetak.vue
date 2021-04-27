<template>
  <div class="container">
    <div class="row">
      <div class="col text-center mb-4">
        <h1>Laporan Pembayaran SPP</h1>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <table class="table border table-striped table-hover">
          <thead>
            <tr>
              <th colspan="4" class="bg-secondary h4 text-center text-light">Biodata Siswa</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>NISN</td>
              <td>:</td>
              <td>{{ tagihan[0].nisn }}</td>
            </tr>
            <tr>
              <td>NIS</td>
              <td>:</td>
              <td>{{ tagihan[0].nis }}</td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td>{{ tagihan[0].nama }}</td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td>{{ tagihan[0].nama_kelas }}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td>{{ tagihan[0].alamat }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md">
        <p class="bg-dark rounded text-light h4 p-3  text-center">Tagihan Siswa</p>
        <table class="table table-striped table-hover">
          <thead class="thead-inverse">
            <tr class="bg-secondary text-light text-center">
              <th class="border">No</th>
              <th class="border">Bulan</th>
              <th class="border">Tahun</th>
              <th class="border">Nominal</th>
              <th class="border">Tanggal Dibayar</th>
              <th class="border">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data,index in tagihan">
              <td class="border">{{ ++index }}</td>
              <td class="border">{{ data.bulan_dibayar }}</td>
              <td class="border">{{ data.tahun }}</td>
              <td class="border">{{ data.nominal }}</td>
              <td class="border">{{ data.tgl_bayar }}</td>
              <td class="border text-danger font-weight-bold">{{ data.tahun_dibayar }}</td>
            </tr>
          </tbody>
        </table>
        <button @click.prevent="cetakan()" class="btn btn-info text-light mb-3 mr-2" id="cetak">
            <i class="fa fa-print" aria-hidden="true"></i> Print
        </button>
        <button @click.prevent="kembali()" class="btn btn-primary text-light mb-3 mr-2" id="kembali">
            <i class="fas fa-backspace    "></i>
        </button>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  props: ["id"],
  data() {
    return {
      tagihan: {}
    };
  },
  mounted() {
    this.getBiodata();
  },
  methods: {
    getBiodata() {
      axios.get("/api/cetak/" + this.id).then(response => {
        this.tagihan = response.data;
      });
    },
    cetakan(){
        document.getElementById("cetak").style.display = "none";
        document.getElementById("kembali").style.display = "none";
        window.print();
        setTimeout((e) => {
            document.getElementById("cetak").style.display = "inline-block";
            document.getElementById("kembali").style.display = "inline-block";
        }, 300);

    },
    kembali(){
        this.$router.push({
            name: 'bayar',
            params: {nisn: this.tagihan[0].nisn}
        })
    }
  }
}
</script>
