const btnCart  = document.querySelector('.container-icon') //se puede cambiar es el identificador del boton.
const containerCartProducts = document.querySelector('.container-cart-products') //Jquery para traer los objetos al catalogo.

btnCart.addEventListener('click', () => {
    containerCartProducts.classList.toggle('hidden-cart')
})

const cartInfo = document.querySelector("cart-product") //Cada producto de ropa del carrito

const productList = document.querySelector('') //Son los propios productos del catalogo.

var allProducts = []
var valorTotal = document.querySelector('.total-pagar')
const countProducts = document.querySelector('#contador-productos')

//crea un objeto nuevo u actualiza la cantidad en vez de crear uno nuevo
productList.addEventListener('click', e => {

    if (e.target.classList.contains('btn-add-cart')){
        const product = e.target.parentElement

        const infoProduct = {
            quantity: 1,
            title: product.querySelector('h4').textContent,
            category: product.querySelector('h5').textContent,
            price: product.querySelector('p').textContent,
        }
        const exists = allProducts.some(product => product.title === infoProduct.title)
        if (exists){
            const products = allProducts.map(product => {
                if(product.title === infoProduct.title){
                    product.quantity++
                    return product
                }
                else{
                    return product
                }
            })
            allProducts = [...products]
        }else{
            allProducts = [...allProducts, infoProduct]
        }

        showHTML();
    }

})

//elimina productos al cerrar y actualiza la pag web
rowProduct.addEventListener('click', (e) => {
    if (e.target.classList.contains('icon-close')){
        const product = e.target.parentElement
        const title = product.querySelector('h4').textContent

        allProducts = allProducts.filter(product => product.title !== title)
        showHTML()
    }
})

const showHTML = () =>{

    if (!allProducts.length){
        containerCartProducts.innerHTML = `<p class=cart-empty> El carrito está vacío</p>`
    }

    rowProduct.innerHTML = '';

    var total = 0;
    var totalOfProducts = 0;



    allProducts.forEach(product =>{
        const containerProduct = document.createElement(div)
        containerProduct.classList.add('cart-product')
        containerProduct.innerHTML= `
        <div class="info-cart-product">
            <span class="cantidad-producto-carrito">1</span>
            <p class="titulo-producto-carrito">Zapatos Nike</p>
            <span class="precio-producto-carrito">$80</span>
        </div>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="icon-close"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
            />
        </svg>
        `
        rowProduct.append(containerProduct)
        total = total + parseInt(product.quantity*product.price.slice(1))
        totalOfProducts = totalOfProducts + products.quantity

    })

    valorTotal.innerText = `$${total}`
    countProducts.innerText = totalOfProducts
}