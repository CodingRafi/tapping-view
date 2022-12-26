<template>
    <header>
        <div class="navbar">
            <h2>ABSENSI</h2>
            <h2>SMKS TARUNA BHAKTI DEPOK</h2>
        </div>
    </header>

    <div class="isi" v-if="!kode_respon && !show">
        <div class="foto">
            <img :src="props.asset.card"
                alt="image" style="width: 500px;height: 500px;object-fit: cover;margin-top: 50px;">
        </div>
    </div>

    <div class="container1 p-0 mt-5" v-if="kode_respon == 1 && show">
        <div class="isi">
            <div class="foto">
                <div v-if="user.profil">
                    <img :src="'https://absensi-dashboard.devlog.my.id/' + user.profil" alt="image"
                        style="width: 300px;height: 300px;border-radius: 50%;object-fit: cover;"
                        v-if="user.profil == '/img/profil.png'">
                    <img :src="'https://absensi-dashboard.devlog.my.id/storage/' + user.profil" alt="image"
                        style="width: 300px;height: 300px;border-radius: 50%;object-fit: cover;" v-else>
                </div>
            </div>
        </div>
        <div class="isi2">
            <div class="data" v-if="role == 'siswa'">
                <p class="nama">{{ siswa.name }}</p>
                <p class="npsn">{{ siswa.npsn }}</p>
                <p class="kelas">{{ kelas.nama }}</p>
                <p class="jurusan">{{ siswa.kompetensi.kompetensi }}</p>
            </div>
            <div class="data" v-if="role == 'guru' || role == 'user'">
                <p class="nama">{{ user.name }}</p>
                <p class="npsn">{{ user.nip }}</p>
            </div>
        </div>

        <!-- table guru -->
        <div class="container mt-5" style="min-width: 70vw;" v-if="role == 'guru'">
            <table class="table table-bordered border-secondary text-center" v-if="agendas.length > 0">
                <thead>
                    <tr class="text-white" style="background-color: #3bae9c">
                        <th scope="col" colspan="2" rowspan="2">HARI/ KELAS</th>
                        <th scope="col" colspan="3" rowspan="2" style="text-transform: capitalize;">{{ hari }}</th>
                    </tr>
                    <tr class="text-white" style="background-color: #3bae9c">
                    </tr>
                    <tr style="background-color: #7de2d1">
                        <th scope="row">JAM-KE</th>
                        <th>WAKTU</th>
                        <th>MAPEL</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="no in agendas.length">
                        <td scope="row">{{ no }}</td>
                        <td>{{ agendas[no - 1].jam_awal.split(':')[0] }}:{{ agendas[no - 1].jam_awal.split(':')[1] }}-{{
                                agendas[no
                                    - 1].jam_akhir.split(':')[0]
                        }}:{{ agendas[no - 1].jam_akhir.split(':')[1] }}</td>
                        <td>{{ agendas[no - 1].mapel }}</td>
                        <td style="text-transform: capitalize;">{{ agendas[no - 1].nama_kelas }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- table siswa -->
        <div class="container mt-5" style="min-width: 70vw;" v-else-if="role == 'siswa'">
            <table class="table table-bordered border-secondary text-center" v-if="agendas.length > 0">
                <thead>
                    <tr class="text-white" style="background-color: #3bae9c">
                        <th scope="col" colspan="2" rowspan="2">HARI/ KELAS</th>
                        <th scope="col" colspan="3" style="text-transform: capitalize;">{{ hari }}</th>
                    </tr>
                    <tr class="text-white" style="background-color: #3bae9c">
                        <th colspan="3">{{ agendas[0].nama_kelas }}</th>
                    </tr>
                    <tr style="background-color: #7de2d1">
                        <th scope="row">JAM-KE</th>
                        <th>WAKTU</th>
                        <th>MAPEL</th>
                        <th>GURU</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="no in agendas.length">
                        <!-- {{ agendas[no - 1].jam_awal }} -->
                        <td scope="row">{{ no }}</td>
                        <td>{{ agendas[no - 1].jam_awal.split(':')[0] }}:{{ agendas[no - 1].jam_awal.split(':')[1] }}-{{
                                agendas[no
                                    - 1].jam_akhir.split(':')[0]
                        }}:{{ agendas[no - 1].jam_akhir.split(':')[1] }}</td>
                        <td>{{ agendas[no - 1].mapel }}</td>
                        <td style="text-transform: capitalize;">{{ agendas[no - 1].guru }}</td>
                    </tr>
                </tbody>
            </table>
            {{ asset }}
        </div>


        <div class="container mt-5" style="min-width: 70vw;" v-else>
            <table class="table table-bordered border-secondary text-center" v-if="agendas.length > 0">
                <thead>
                    <tr class="text-white" style="background-color: #3bae9c">
                        <th scope="col" colspan="2" rowspan="2">HARI/ KELAS</th>
                        <th scope="col" colspan="3" style="text-transform: capitalize;">{{ hari }}</th>
                    </tr>
                    <tr style="background-color: #7de2d1">
                        <th scope="row">JAM-KE</th>
                        <th>WAKTU</th>
                        <th>Aktifitas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="no in agendas.length">
                        <!-- {{ agendas[no - 1].jam_awal }} -->
                        <td scope="row">{{ no }}</td>
                        <td>{{ agendas[no - 1].jam_awal.split(':')[0] }}:{{ agendas[no - 1].jam_awal.split(':')[1] }}-{{
                                agendas[no
                                    - 1].jam_akhir.split(':')[0]
                        }}:{{ agendas[no - 1].jam_akhir.split(':')[1] }}</td>
                        <td>{{ agendas[no - 1].other }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input type="text" name="" class="input-rfid" autofocus>
    <div class="rfid">
        <div class="tiban"></div>
    </div>
</template>
  
<style scoped>
.rfid {
    margin-top: 5rem;
}

.input-rfid {
    position: absolute;
    margin-top: 5px;
}

.tiban {
    background-color: white;
    color: white;
    width: 100vw;
    height: 10vh;

}

.container {
    min-width: 100vw;
    min-height: 100vh;
    background-color: white;
}

header {
    line-height: 1.5;
    max-height: 100vh;
}

.isi {
    display: flex;
    justify-content: center;
    margin-top: auto 100px;
}

.isi2 {
    display: flex;
    justify-content: center;
}

.data {
    text-align: center;
    line-height: 30px;
    margin-top: 30px;
}

.nama {
    font-size: 50px;
    font-weight: 500;
}

.npsn,
.kelas,
.jurusan {
    font-size: 30px;
}

.foto {
    display: flex;
    justify-content: center;
}

#carouselExampleControls {
    margin-top: 50px;
    width: 100vw;
    overflow: hidden;
}

.navbar {
    width: 100vw;
    background-color: #3bae9c;
    display: block;
    text-align: center;
}

h2 {
    color: white;
}
</style>
  
<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  asset: Object
})

const kode_respon = ref()
const hari = ref()
const agendas = [];
const user = ref([]);
const message = ref();
const role = ref();
const kelas = ref();
const kompetensi = ref();
let detik = 0;
let show = ref(false);

const hitungDetik = function () {
    detik++;
    if (detik == 15) {
        show.value = false;
        detik = 0;
        kode_respon.value = '';
    } else if (detik <= 15 && show.value) {
        setTimeout(() => {
            hitungDetik();
        }, 1000);
    }
};

onMounted(() => {
    const inputRfid = document.querySelector('.input-rfid');
    inputRfid.addEventListener('change', function (e) {
        if (detik <= 15) {
            detik = 0;
            show.value = false;
            fetch(e);
        } else {
            fetch(e);
        }
    })

    const fetch = function (e) {
        axios.post('/api/absen', {
            rfid: e.target.value
        }).then((response) => {
            console.log(response)
            return response
        }).then((response) => {
            console.log(response)
        })
    }
})
</script>
  