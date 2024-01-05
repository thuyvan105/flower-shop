<?php

// unset($_SESSION['cart']);
// var_dump($_SESSION['cart']);

// function addCart($pdID)
// {
//     if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {


//     }
// }

function total() {
    $total = 0;
    // ktra cart ttai & là 1 mảng hay kh có ->
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // duyệt qua twfg ptu moi ptu là 1 sp sau đó gán vào $pd
        foreach ($_SESSION['cart'] as $pd) {
            if (is_array($pd)) { //ktra là mảng hay kh 
                $tien = 0;
                $tien = $pd[3]*$pd[4];
                $total += $tien;
            }
        }
        return $total;
    }
}

function showCartItems()
{
    $cartHTML = ''; 
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $pd) {
            if (is_array($pd)) {
                $cartHTML .= '<div class="js-append">
                <div class="row" style="margin: 15px 0 !important;text-align:center;margin:50px 0;width:100% !important">
                    <img style="width:100% !important" src="' . $pd[1] . '">
                    <h4>' . $pd[2] . '</h4>
                    <h5 style="margin-left:auto"> $' . $pd[3] . '</h5>
                    <div class="top">HOT</div>
                    <div class="js-delete-item" style="position:absolute;top:4px;right:4px;border:1px solid #ccc;border-radius:50%;z-index:200;background:white;padding:2px 8px;">
                        <a data-page= "' . $pd[0] . '" class="delete">X</a>
                    </div>
                    <div class="quality" style="display:flex;width:100%;justify-content: space-between;padding:8px;border-radius:8px;">
                        <div>Quantity:</div>
                        <div class="amount fl-ct amoJS" style="display:flex;align-items:center">
                            <div class="minus hov-df amoM" style="font-size:30px;line-height:16px;">-</div>
                            <input type="number" class="number rs-form amoVal m-change-quantity" style="outline:none;border:none;text-align:center;margin-left:10px;" value="' . $pd[4] . '" min="0" max="999">
                            <div class="plus hov-df amoP" style="font-size:22px;line-height:16px">+</div>
                        </div>
                    </div>
                </div>
            </div>';
            }
        }
        //lưu giỏ hàng vào cookie
        $user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 'guest';
        $cartJson = json_encode($_SESSION['cart']);
        setcookie('cart_' . $user_id, $cartJson, time() + (30 * 86400), '/');
    }

    return $cartHTML;
}


function deleteItem($pdID)
{
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productKey => $p) {
            if (is_array($p)) {
                if ($p[0] === $pdID) {
                    unset($_SESSION['cart'][$productKey]);
                }

            }
        }
    }
}


?>