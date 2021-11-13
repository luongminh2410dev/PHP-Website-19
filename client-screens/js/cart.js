function addToCart(id) {
  $.ajax({
    url: "cart.php",
    type: "post",
    dataType: "json",
    data: {
      productId: id,
      type: "add",
    },
    success: function (response) {
      if (response == "success") {
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Đã thêm vào giỏ hàng";
        x.style.backgroundColor = "rgb(53, 147, 201)";
        setTimeout(function () {
          x.className = x.className.replace("show", "");
        }, 3000);
        $("#cart").load(" #cart > *");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR, errorThrown);
    },
  });
}

function addToCartWithQuantity(id) {
  var quantity = $("#quantity").val();
  $.ajax({
    url: "cart.php",
    type: "post",
    dataType: "json",
    data: {
      productId: id,
      quantity: quantity,
      type: "add",
    },
    success: function (response) {
      if (response == "success") {
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Đã thêm vào giỏ hàng";
        x.style.backgroundColor = "rgb(53, 147, 201)";
        setTimeout(function () {
          x.className = x.className.replace("show", "");
        }, 3000);
        $("#cart").load(" #cart > *");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR, errorThrown);
    },
  });
}

function removeFromCart(id) {
  $.ajax({
    url: "cart.php",
    type: "post",
    dataType: "json",
    data: {
      idItemCart: id,
      type: "remove",
    },
    success: function (response) {
      if (response == "success") {
        $("#cart").load(" #cart > *");
        $("#cart-container").load(" #cart-container > *");
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Đã xóa khỏi giỏ hàng";
        x.style.backgroundColor = "#bb1b36";
        setTimeout(function () {
          x.className = x.className.replace("show", "");
        }, 3000);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR, errorThrown);
    },
  });
}

function updateCart(event, id) {
  var selectElement = event.target;
  var quantity = selectElement.value;
  $.ajax({
    url: "cart.php",
    type: "post",
    dataType: "json",
    data: {
      idItemCart: id,
      quantity: quantity,
      type: "update",
    },
    success: function (response) {
      if (response == "success") {
        $("#cart-container").load(" #cart-container > *");
        $("#cart").load(" #cart > *");
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Đã cập nhật giỏ hàng";
        x.style.backgroundColor = "#249b49";
        setTimeout(function () {
          x.className = x.className.replace("show", "");
        }, 3000);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR, errorThrown);
    },
  });
}

function addToWhishlist(id) {
  $.ajax({
    url: "whishlist.php",
    type: "post",
    dataType: "json",
    data: {
      productId: id,
      type: "add",
    },
    success: function (response) {
      if (response == "success") {
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Đã thêm vào danh sách yêu thích";
        x.style.backgroundColor = "rgb(53, 147, 201)";
        setTimeout(function () {
          x.className = x.className.replace("show", "");
        }, 3000);
        $("#whishlist").load(" #whishlist > *");
      }
      if (response == "exist") {
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Sản phẩm đã tồn tại trong danh sách yêu thích";
        x.style.backgroundColor = "#bb1b36";
        setTimeout(function () {
          x.className = x.className.replace("show", "");
        }, 3000);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR, errorThrown);
    },
  });
}

removeFromWhishlist();

function removeFromWhishlist(id) {
  $.ajax({
    url: "whishlist.php",
    type: "post",
    dataType: "json",
    data: {
      productId: id,
      type: "remove",
    },
    success: function (response) {
      if (response == "success") {
        var x = document.getElementById("snackbar");
        x.className = "show";
        x.innerHTML = "Đã xóa khỏi danh sách yêu thích";
        x.style.backgroundColor = "#bb1b36";
        setTimeout(function () {
          x.className = x.className.replace("show", "");
        }, 3000);
        $("#whishlist-container").load(" #whishlist-container > *");
        $("#whishlist").load(" #whishlist > *");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR, errorThrown);
    },
  });
}
