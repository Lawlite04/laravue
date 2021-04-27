<template>
    <ul class="navbar-nav justify-content-center">
        <li class="nav-item">
            <router-link :to="{name: 'home-admin'}" class="nav-link" href="#">Home</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'spp'}" class="nav-link" href="#">SPP</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'kelas'}" class="nav-link" href="#">Kelas</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'petugas'}" class="nav-link" href="#">Petugas</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'siswa'}" class="nav-link" href="#">Siswa</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'transaksi'}" class="nav-link" href="#">Transaksi</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'history'}" class="nav-link" href="#">History</router-link>
        </li>
    </ul>
</template>
