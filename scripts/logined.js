// noinspection RegExpSingleCharAlternation,RegExpRedundantEscape,ES6ConvertVarToLetConst

// Import dependencies
import { foodItem } from './food.js';

// Function to create list based on category and name filter
function createList(category, name) {
    const dish = document.getElementById(nameToVar(category));
    var i = 0;
    dish.innerHTML = `<p id="category-name">${category.charAt(0).toUpperCase() + category.slice(1)}</p>`;

    const dishData = foodItem.filter(item => item.category === category);

    dishData.forEach(item => {
        const iName = item.name.toLowerCase();
        if ((name !== null && iName.includes(name.toLowerCase())) || name === null) {
            i = 1;
            const itemCard = document.createElement('div');
            itemCard.setAttribute('id', 'item-card');

            const cardTop = document.createElement('div');
            cardTop.setAttribute('id', 'card-top');

            const star = document.createElement('i');
            star.setAttribute('class', 'fa fa-star');
            star.setAttribute('id', 'rating');
            star.innerText = ` ${item.rating}`;

            const heart = document.createElement('i');
            heart.innerText = 'Add';
            heart.setAttribute('class', 'fa fa-heart-o add-to-cart');
            heart.setAttribute('id', item.id);

            cardTop.appendChild(star);
            cardTop.appendChild(heart);

            const img = document.createElement('img');
            img.src = item.img;

            // Event listener to display description on image click
  

            
            const itemName = document.createElement('p');
            itemName.setAttribute('id', 'item-name');
            itemName.innerText = item.name;

            const itemPrice = document.createElement('p');
            itemPrice.setAttribute('id', 'item-price');
            itemPrice.innerText = `Price : $ ${item.price}`;


          
            itemCard.appendChild(cardTop);
            itemCard.appendChild(img);
            itemCard.appendChild(itemName);
            itemCard.appendChild(itemPrice);



            dish.appendChild(itemCard);
        }
    });

    if (i === 0) {
        dish.innerHTML = ``;
    }
}
// Function to display items based on search name
function displayItems(name) {
    const categories = ['phở', 'cơm', 'hủ tiếu', 'mì', 'bánh mì', 'đồ ăn chay'];
    categories.forEach(category => {
        createList(category, name);
    });
}

// Initial display with no search filter
displayItems(null);

// Event listener for search button click
const search = document.getElementById('btn-search');
search.addEventListener('click', event => {
    event.preventDefault();
    searchTaste();
});

// Event listener for search box focus
const find = document.getElementById('search-box');
find.addEventListener('focus', () => {
    find.addEventListener('keypress', event => {
        if (event.key === 'Enter') {
            searchTaste();
        }
    });
});

// Function to handle search based on user input
function searchTaste() {
    const name = document.getElementById('search-box').value.trim();
    displayItems(name);
}


const vegData = [...new Map(foodItem.map(item => [item['category'], item])).values()];

function selectTaste() {
    var categoryList = document.getElementById('category-list');

    vegData.map(item => {
        console.log(item);
        var listCard = document.createElement('div');
        listCard.setAttribute('class', 'list-card');

        var listImg = document.createElement('img');
        listImg.src = item.img;

        var listName = document.createElement('a');
        listName.setAttribute('class', 'list-name');
        listName.innerText = item.category;
        listName.setAttribute('href', '#' + nameToVar(item.category));

        listCard.appendChild(listImg);
        listCard.appendChild(listName);

        var cloneListCard = listCard.cloneNode(true);
        categoryList.appendChild(listCard);
        document.querySelector('.category-header').appendChild(cloneListCard);
    });
}

selectTaste();

function nameToVar(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g, " ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");

    var splitStr = str.toLowerCase().split(' ');
    for (var i = 1; i < splitStr.length; i++) {
        // You do not need to check if i is larger than splitStr length, as your for does that for you
        // Assign it back to the array
        splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
    }
    // Directly return the joined string
    return splitStr.join('');
}

var cartData = [];

function addToCart() {
    var itemToAdd = this.parentNode.nextSibling.nextSibling.innerText;
    var itemObj = foodItem.find(element => element.name == itemToAdd);

    var index = cartData.indexOf(itemObj);
    if (index === -1) {
        cartData = [...cartData, itemObj];
    } else if (index > -1) {
        alert("Added to cart!");
    }

    document.getElementById('cart-plus').innerText =
        ' ' + cartData.length + ' Items';
    document.getElementById('m-cart-plus').innerText =
        ' ' + cartData.length;
    totalAmount();
    cartItems();
}



function cartItems() {
    var tableBody = document.getElementById('table-body');
    tableBody.innerHTML = '';

    cartData.map(item => {
        var tableRow = document.createElement('tr');

        var rowData1 = document.createElement('td');
        var img = document.createElement('img');
        img.src = item.img;
        rowData1.appendChild(img);

        var rowData2 = document.createElement('td');
        rowData2.innerText = item.name;

        var rowData3 = document.createElement('td');
        var btn1 = document.createElement('button');
        btn1.setAttribute('class', 'decrease-item');
        btn1.innerText = '-';
        var span = document.createElement('span');
        span.innerText = item.quantity;
        var btn2 = document.createElement('button');
        btn2.setAttribute('class', 'increase-item');
        btn2.innerText = '+';

        rowData3.appendChild(btn1);
        rowData3.appendChild(span);
        rowData3.appendChild(btn2);

        var rowData4 = document.createElement('td');
        rowData4.innerText = item.price;

        tableRow.appendChild(rowData1);
        tableRow.appendChild(rowData2);
        tableRow.appendChild(rowData3);
        tableRow.appendChild(rowData4);

        tableBody.appendChild(tableRow);
    })
    document.querySelectorAll('.increase-item').forEach(item => {
        item.addEventListener('click', incrementItem)
    })

    document.querySelectorAll('.decrease-item').forEach(item => {
        item.addEventListener('click', decrementItem)
    })
}

function incrementItem() {
    let itemToInc = this.parentNode.previousSibling.innerText;
    console.log(itemToInc)
    var incObj = cartData.find(element => element.name == itemToInc);
    incObj.quantity += 1;

    currPrice = (incObj.price * incObj.quantity - incObj.price * (incObj.quantity - 1)) / (incObj.quantity - 1);
    incObj.price = currPrice * incObj.quantity;
    totalAmount()
    cartItems();
}

var currPrice = 0;

function decrementItem() {
    let itemToInc = this.parentNode.previousSibling.innerText;
    let decObj = cartData.find(element => element.name == itemToInc);
    let ind = cartData.indexOf(decObj);
    if (decObj.quantity > 1) {
        currPrice = (decObj.price * decObj.quantity - decObj.price * (decObj.quantity - 1)) / (decObj.quantity);
        decObj.quantity -= 1;
        decObj.price = currPrice * decObj.quantity;
    } else {
        document.getElementById(decObj.id).classList.remove('toggle-heart')
        cartData.splice(ind, 1);
        document.getElementById('cart-plus').innerText = ' ' + cartData.length + ' Items';
        document.getElementById('m-cart-plus').innerText = ' ' + cartData.length;
        if (cartData.length < 1 && flag) {
            document.getElementById('food-items').classList.toggle('food-items');
            document.getElementById('category-list').classList.toggle('food-items');
            document.getElementById('m-cart-plus').classList.toggle('m-cart-toggle')
            document.getElementById('cart-page').classList.toggle('cart-toggle');
            document.getElementById('category-header').classList.toggle('toggle-category');
            document.getElementById('checkout').classList.toggle('cart-toggle');
            flag = false;
            alert("Currently no item in cart!");
            console.log(flag)
        }
    }
    totalAmount()
    cartItems()
}

function totalAmount() {
    var sum = 0;
    cartData.map(item => {
        sum += item.price;
    })
    document.getElementById('total-item').innerText = 'Total Item : ' + cartData.length;
    document.getElementById('total-price').innerText = 'Total Price : $ ' + sum;
    document.getElementById('m-total-amount').innerText = 'Total Price : $ ' + sum;
}

document.getElementById('cart-plus').addEventListener('click', cartToggle);
document.getElementById('m-cart-plus').addEventListener('click', cartToggle);

var flag = false;

function cartToggle() {
    if (cartData.length > 0) {
        document.getElementById('food-items').classList.toggle('food-items');
        document.getElementById('category-list').classList.toggle('food-items');
        document.getElementById('category-header').classList.toggle('toggle-category');
        document.getElementById('m-cart-plus').classList.toggle('m-cart-toggle')
        document.getElementById('cart-page').classList.toggle('cart-toggle');
        document.getElementById('checkout').classList.toggle('cart-toggle');
        flag = true;
        console.log(flag)

        var checkout = document.querySelectorAll('.cart-btn')

        checkout.forEach(function(button) {
            button.addEventListener('click', function() {
                saveCartDataToFile();
                window.location.href = 'your_order.php';
                alert('Checkout successful!');
            });
        });
    } else {
        alert("Currently no item in cart!");
    }
}

window.onresize = window.onload = function () {
    var size = window.screen.width;
    console.log(size)
    if (size < 800) {
        var cloneFoodItems = document.getElementById('food-items').cloneNode(true);
        var cloneCartPage = document.getElementById('cart-page').cloneNode(true);
        document.getElementById('food-items').remove();
        document.getElementById('cart-page').remove();
        document.getElementById('category-header').after(cloneFoodItems);
        document.getElementById('food-items').after(cloneCartPage); 
        addEvents()
    }
    if (size > 800) {
        var cloneFoodItems = document.getElementById('food-items').cloneNode(true);
        document.getElementById('food-items').remove();
        document.getElementById('header').after(cloneFoodItems);

        var cloneCartPage = document.getElementById('cart-page').cloneNode(true);
        document.getElementById('cart-page').remove();
        document.getElementById('food-items').after(cloneCartPage);
        addEvents()
    }
}

function addEvents() {
    document.querySelectorAll('.add-to-cart').forEach(item => {
        item.addEventListener('click', addToCart)
    });
    document.querySelectorAll('.increase-item').forEach(item => {
        item.addEventListener('click', incrementItem)
    })

    document.querySelectorAll('.decrease-item').forEach(item => {
        item.addEventListener('click', decrementItem)
    })
}

document.getElementById('add-address').addEventListener('click', addAddress);

document.getElementById('m-add-address').addEventListener('click', addAddress);

function addAddress() {
    var address = prompt('Enter your address', '');
    if (address) {
        document.getElementById('add-address').innerText = ' ' + address;
    } else {
        alert("Address not added")
    }
}

console.log("User email:", userEmail);

function saveCartDataToFile() {
    // Create content for the JavaScript file
    let content = `var cartData = {\n`;
    content += `    "order": {\n`;
    content += `        "itemnames": [`;

    // Iterate over cartData to include item details
    cartData.forEach((item, index) => {
        if (index !== 0) {
            content += ', ';
        }
        content += `"${item.name}"`;
    });

    content += `],\n`;

    // Calculate total price
    let totalPrice = cartData.reduce((total, item) => total + parseFloat(item.price), 0);
    content += `        "totalprice": ${totalPrice},\n`;
    content += `        "userEmail": "${userEmail}",\n`;
    content += `        "address": "${document.getElementById('add-address').innerText.trim()}"\n`; // corrected the syntax here, closing quotes for "address"

    content += `    }\n`;
    content += `};`;

    // Send content to a PHP script to handle file writing
    fetch('save_cart_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ content: content })
    }).then(response => {
        // Handle response
        console.log(response);
    }).catch(error => {
        // Handle error
        console.error(error);
    });
}