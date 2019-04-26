<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
    }
    public function index()
    {
        exit;
    }
    public function cart()
    {
        $data['check_login'] = $this->check_use;
        $id = intval($this->input->post('id'));
        $qty = intval($this->input->post('qty'));
        if ($id > 0)
        {
            $array = array();
            $array['select'] = '*';
            $array['table'] = 'product';
            $array['where'] = array('id' =>$id);
            $product =  $this->product_model->get($array);

            if (isset($product) && count($product) > 0)
            {
                if ($product['type'] !='code' )
                {
                    if ((int)$product['quantity'] < $qty)
                    {
                        $qty_cart = (int)$product['quantity'];
                    }
                    else
                    {
                        $qty_cart = $qty  ;
                    }
                }
                else
                {
                    $qty_cart = 1;
                }
                if (isset($product['fake_price']) && $product['fake_price'] > 0  )
                {
                    $price = $product['fake_price'];
                }
                else
                {
                    $price = $product['price'];
                }
                $data = array(
                    'id' => $product['id'],
                    'qty' => $qty_cart,
                    'price' => $price,
                    'name' => $product['name'],
                    'options' => array(
                        'thumb' => $product['thumb'],
                        'alias' => $product['alias'],
                        'type' =>$product['type']
                    )

                );
                $this->cart->insert($data);
                ?>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-sm-6 cart-popup__cell">
                        <h5 class="cart-popup-item__header ">
                            <span class="glyphicon glyphicon-ok"></span>
                            1 sản phẩm mới đã được thêm vào giỏ hàng của bạn
                        </h5>
                        <div class="cart-popup-product cart-popup-product_main cart-popup-product_quantity">
                            <div class="col-lg-6 col-sm-6 col-sm-12 cart-popup-product-img">
                                <a class="cart-popup-product__link" href="/sp/<?=$product['alias']?>.html">
                                    <img class="cart-popup-product__img img-responsive" src="<?=$product['thumb']?>" onerror="$(this).attr('src','<?=$product['thumb']?>')">
                                </a>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-sm-12 ">
                                <h2 class="cart-popup-product__title"><?=$product['name']?></h2>
                                <?php
                                if (isset($product['fake_price']) && $product['fake_price'] > 0  )
                                {
                                    ?>
                                    <div class="cart-popup-product__paid-price"><?=number_format($product['fake_price'])?> VND</div>
                                    <div class="cart-popup-product__discount-block">
                                        <div class="cart-popup-product__original-unit-price"><?=number_format($product['price'])?> VND</div>
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <div class="cart-popup-product__paid-price"><?=number_format($product['price'])?> VND</div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-sm-6 cart-popup__cell_summary">
                        <h5 class="summary-header">
                            <span class="txt-large txt-black mrs">Giỏ hàng của tôi</span>
                            <span class="txt-light-blue txt-normal txt-medium">
                                                (<?=intval($this->cart->total_items());?> sản phẩm)
                                            </span>
                            <a href="http://www.lazada.vn/cart/">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </h5>
                        <div class="summary-main table mtm">
                            <div class="summary-subtotal">
                                <span class="col">Tạm tính:</span>
                                <span class="col text-right"><?=number_format($this->cart->total())?> VND</span>
                            </div>
                        </div>
                        <div class="summary-total">
                                            <span class="col txt-size-small">
                                                    <span class="txt-bold txt-black">Tổng tiền</span>
                                                    <span class="txt-grey">(Tổng số tiền thanh toán):</span>
                                                </span>
                            <h3 class="col text-right"><?=number_format($this->cart->total())?> VND</h3>
                        </div>
                        <div class="summary-control mt15 mbs">
                            <input type="hidden" id="totalAmountCartItems" value="3">
                            <span class="continue-shopping-wrap col" data-dismiss="modal">
                                                  <a class="sel-continue-shopping continue-shopping nyroModalClose js-continue-shopping" href="#"><span class="tieptuc">Tiếp tục mua hàng</span> </a>
                                                </span>
                            <a class="add-cart" href="/cart.html">
                                <span class="btn-checkout-text">Đặt hàng</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
            {
                echo 'không thấy';
            }
        }
    }
    public function emptycart()
    {
        $this->cart->destroy();
    }

    public function remove_cart()
    {
        $rowid = $this->input->post('rowid');
        if($rowid){
            $this->cart->remove($rowid);
        }
    }
    public function update_count()
    {
        echo intval($this->cart->total_items());
    }
    public function totalmoney()
    {
        echo ' '.number_format($this->cart->total()).' VND';
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */
