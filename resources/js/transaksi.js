import Vue from 'vue'
import axios from 'axios'
import VueSweetalert2 from 'vue-sweetalert2';

Vue.filter('currency', function (money) {
    return accounting.formatMoney(money, "Rp ", 2, ".", ",")
})
Vue.use(VueSweetalert2);

new Vue({
    el: '#dw',
    data: {
        barang: {
            id: '',
            hargaJualSatuan: '',
            namaBarang: ''
        },
        cart: {
            barang_id: '',
            qty: ''
        },
        shoppingCart: [],
        total: [],
        submitCart: false,
        submitForm: false,
        errorMessage: '',
        message: ''
    },
    watch: {
        'cart.barang_id': function() {
            if (this.cart.barang_id) {
                this.getBarang()
            }
        },
    },
    mounted() {
        $('#barang_id').select2({
            width: '100%'
        }).on('change', () => {
            this.cart.barang_id = $('#barang_id').val();
        });
        $('#qty').on('keyup', () => {
            this.cart.qty = $('#qty').val();
        })
        this.getCart();
        this.getTotal()
    },
    methods: {
        getBarang() {
            axios.get(`/api/barang/${this.cart.barang_id}`)
                .then((response) => {
                    this.barang = response.data
                })
        },
        addToCart() {
            this.submitCart = true;
            axios.post('/api/cart', this.cart)
                .then((response) => {
                    setTimeout(() => {
                        this.shoppingCart = response.data
                        this.cart.barang_id = ''
                        this.cart.qty = ''
                        this.barang = {
                            id: '',
                            hargaJualSatuan: '',
                            namaBarang: ''
                        }
                        $('#barang_id').val('')
                        this.submitCart = false
                    }, 2000)
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        getCart() {
            axios.get('/api/cart')
                .then((response) => {
                    this.shoppingCart = response.data
                })
        },
        getTotal() {
            axios.get('/api/total')
                .then((response) => {
                    this.total = response.data
                })
        },
        removeCart(id) {
            this.$swal({
                title: 'Kamu Yakin?',
                text: 'Kamu Tidak Dapat Mengembalikan Tindakan Ini!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, Lanjutkan!',
                cancelButtonText: 'Tidak, Batalkan!',
                showCloseButton: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve) => {
                        setTimeout(() => {
                            resolve()
                        }, 2000)
                    })
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then ((result) => {
                if (result.value) {
                    axios.delete(`/api/cart/${id}`)
                        .then ((response) => {
                            this.getCart();
                        })
                        .catch ((error) => {
                            console.log(error);
                        })
                }
            })
        },
        sendOrder() {
            this.errorMessage = ''
            this.message = ''
            this.$swal({
                title: 'Kamu Yakin?',
                text: 'Kamu Tidak Dapat Mengembalikan Tindakan Ini!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, Lanjutkan!',
                cancelButtonText: 'Tidak, Batalkan!',
                showCloseButton: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve) => {
                        setTimeout(() => {
                            resolve()
                        }, 2000)
                    })
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then ((result) => {
                if (result.value) {
                    this.submitForm = true
                    axios.post('/transaksi/checkout')
                        .then((response) => {
                            setTimeout(() => {
                                this.getCart();
                                this.message = response.data.message
                                this.submitForm = false
                            }, 1000)
                        })
                        .catch((error) => {
                            console.log(error)
                        })
                }
            })
        },
    }
})
