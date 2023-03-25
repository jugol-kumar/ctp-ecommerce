import {defineStore} from "pinia";


export const useCartStore = defineStore('cart',{

    state: () => ({
        cart:[]
    }),

    actions:{
        addToCart(product){
            this.cart.push(product);
            this.setInLocalStorage();
        },
        removeFromCart(item) {
            const index = this.cart.indexOf(item);
            if (index > -1) {
                this.cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(this.cart));
            }
        },
        incrementQty(id){
            const itemIndex = this.cart.findIndex(item => item.id === id);
            this.cart[itemIndex].quantity++;
            this.setInLocalStorage();
        },
        setInLocalStorage(){
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        initCart() {
            const storedCart = localStorage.getItem('cart');
            if (storedCart) {
                this.cart = JSON.parse(storedCart);
            }
        },
        clearCart(){
            this.items = [];
            localStorage.removeItem("cart");
        }
    },

    getters:{
        getCartLength(){
            return this.cart.length;
        },
        getCartItems(){
            return this.cart;
        },
        getCartTotalPrice(){
            return this.cart.reduce((total, item) => total + item.price * item.quantity, 0)
        }
    }

})
