<!--breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li><a href="/">Tiếp tục mua hàng</a></li>
            <li class="active">Check Out page</li>
        </ol>
    </div>
</div>
<!--//breadcrumbs-->
<!--cart-items-->
<div class="cart-items">
    <div class="container">
       <div class="row">
           <?php
            if (isset($return))
            {
                ?>
                <div class="col-lg-12">
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning! </strong> <?=$return['text']?>
                    </div>
                </div>
                <?php
            }
           ?>
              <?php
                    $cart = $this->cart->contents();
                  if (isset($cart) && count($cart)>0)
                  {
                      ?>
                        <div class="col-lg-8 col-sm-8 col-xs-12">
                            <h3 class="wow fadeInUp animated"  data-wow-delay=".5s">Giỏ hàng của tôi (<span id="simpleCart_quantity_2"><?=intval($this->cart->total_items());?></span>)</h3>
                      <?php
                      foreach ($cart as $items)
                      {
                          ?>
                          <div class="cart-header wow fadeInUp animated" data-wow-delay=".5s" id="cart_<?=$items['rowid']?>">
                              <a class="alert-close" onclick="removecart('<?=$items['rowid']?>')"></a>
                              <div class="cart-sec simpleCart_shelfItem">
                                  <div class="cart-item cyc">
                                      <a href="/sp/<?=$items['options']['alias']?>.html"><img src="<?=$items['options']['thumb']?>" class="img-responsive" alt=""></a>
                                  </div>
                                  <div class="cart-item-info">
                                      <h4><a href="/sp/<?=$items['options']['alias']?>.html"><?=$items['name']?></h4>
                                      <ul class="qty">
                                          <li><p>Số lượng :</p></li>
                                          <li><p><?=$items['qty']?></p></li>
                                      </ul>
                                      <div class="delivery">
                                          <p>Giá : <?=number_format($items['price'])?> VND / 1 sản phẩm</p>
                                          <div class="clearfix"></div>
                                      </div>
                                  </div>
                                  <div class="clearfix"></div>
                              </div>
                          </div>
                          <?php
                      }
                      ?>
                        </div>
                      <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp animated cart-order-summary" data-wow-delay=".5s">
                          <div class="cart-order-summary size1of3 unitRight box-sizing pll">
                              <div class="cart-summary order-summary-cart-page">
                                  <h3 class="wow fadeInUp animated" data-wow-delay=".5s">Thông tin đơn hàng</h3>
                                  <div class="summary-main table mtm">
                                      <div class="summary-subtotal">
                                          <span class="col">Tạm tính:</span>
                                          <span class="col text-right" id="totalmoney"><?=number_format($this->cart->total())?> VND</span>
                                      </div>
                                  </div>
                                  <div class="summary-total table border-grey-top mtm ptm">
                            <span class="col txt-size-small">
                                <span class="txt-bold txt-black">Tổng tiền</span>
                                </span>
                                      <h3 class="col text-right" id="totalmoney2"><?=number_format($this->cart->total())?> VND</h3>
                                  </div>
                                  <div class="summary-control table mt15 mbs">
                                     <form method="post" id="cart" action="">
                                         <input type="hidden" name="oke" value="">
                                         <a onclick="validateForm()" class="add-cart" href="#">
                                             <span class="btn-checkout-text">Tiến hành thanh toán</span>
                                         </a>
                                     </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                     <?php
                  }
                  else
                  {
                      ?>
                      <div class="col-lg-12">
                          <div class="alert alert-warning" role="alert">
                              <strong>Warning!</strong> Giỏ hàng không tồn tại.
                          </div>
                      </div>
                      <?php
                  }
              ?>


       </div>
    </div>
</div>
<script>
    function validateForm() {
        document.getElementById("cart").submit();
        return true
    }
</script>
<!--//cart-items-->