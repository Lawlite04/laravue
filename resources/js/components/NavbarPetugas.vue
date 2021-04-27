<template>
    <ul class="navbar-nav justify-content-center">
        <li class="nav-item">
            <router-link :to="{name: 'home_petugas'}" class="nav-link" href="#">Home</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'Siswa'}" class="nav-link" href="#">Data Siswa</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'transaksi'}" class="nav-link" href="#">Transaksi</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{name: 'historyPetugas'}" class="nav-link" href="#">History</router-link>
        </li>
    </ul>
</template>
