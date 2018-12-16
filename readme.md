# Project 4
+ By: Maggie Crocamo
+ Production URL: <http://p4.maggiecroc11.me>

## Application
+ Title: The Sundae King
+ An application that allows a user to buy customized sundaes and have them shipped to the address they specified.

## Database

Primary tables:
  + `basketitems` : table which holds all individual items that a user currently has in their cart
  + `baskets`: table which stores the main instance of a basket per user
  + `orders`: table which stores the main information when an order is placed
  + `orderitems`: table which stores information about the individual items per order
   + `flavors` : table which stores all the flavors of ice cream
    + `topiings`: table which stores all the toppings and their prices
    + `sizes`: table which stores all the sizes and their prices
  
Pivot table(s):
  + `basketitem_flavor`: Links items in the basket to what flavors they are
   + `basketitem_topping`: Links items in the basket to what topppings they have
    + `flavor_orderitem`: Links items in an order to what flavors they are
     + `orderitem_topping`: Links items in an order to what toppings they have


## CRUD

__Create__
  + Visit <http://p4.maggiecroc11.me/show>
  + Choose flavors, toppings, quantity, and size for new sundae
  + Click *Add to Cart*
  + Observe confirmation message which says how many items were added to your cart
  
__Read__
  + Visit <http://p4.maggiecroc11.me/show> or <http://p4.maggiecroc11.me/cart> to see a listing of all flavors, toppings, and sizes available or all sundae items added to the user's cart.
  
__Update__
  + Visit <http://p4.foobooks.me/cart>; choose the Update button next to one of the items (once you've added an item to your cart)
  + Make some edit to form
  + Click *Update Cart*
  + Observe confirmation message
  
__Delete__
  + Visit <http://p4.foobooks.me/cart>; click the Remove button next to one of the items (once you've added an item to your cart)
  + Confirm deletion
  + Observe confirmation message

## Outside resources
+ I used some code for the nav and some css styling from foobooks
### Resouces for Images
#### All images were used for educational purposes and found using google images
+ vanilla: https://bpsfuelforthought.files.wordpress.com/2014/01/vanilla-ice-cream.jpg
+ chocolate: https://images.food52.com/HzawX1ZSKt66oQYV97SG0QSGwbI=/753x502/ad0a5aeb-c9e3-4ba2-877e-266f33c06b76--food52_02-19-13-0043.jpg
+ cherry: https://d1wv4dwa0ti2j0.cloudfront.net/live/img/production/detail/ice-cream/cartons_rich-creamy_cherry-vanilla.jpg
+ chunky monkey: https://www.benjerry.com/files/live/sites/systemsite/files/flavors/products/us/pint/open-closed-pints/chunky-monkey-landing-open.png
+ half-baked: https://www.benjerry.com/files/live/sites/systemsite/files/flavors/flavors-redesign-details-2016/ecommerce-assets/pints/Half_Baked_11_mobile.jpg
+ chocolate-fudge-brownie: https://lifemadesimplebakes.com/wp-content/uploads/2015/07/Brownie-Fudge-Swirl-Ice-Cream-3.jpg
+ chocolate-chip: https://d1wv4dwa0ti2j0.cloudfront.net/live/img/production/detail/ice-cream/cartons_rich-creamy_chocolate-chip.jpg
+ cookie monster: https://www.cupcakediariesblog.com/2016/06/cookie-monster-ice-cream.html
+ graham-slam: https://i.pinimg.com/originals/70/7b/6e/707b6e9c75805791e097efcd4c303279.jpg
+ oreo: https://cdn.cpnscdn.com/static.coupons.com/ext/kitchme/images/recipes/600x400/easy-oreo-cookies-and-cream-ice-cream_32301.jpg
+ chocolate peanut butter : https://joyfoodsunshine.com/wp-content/uploads/2016/07/dairy-free-chocolate-peanut-butter-ice-cream-recipe-4.jpg
+ fudge-swirl: https://lmld.org/no-churn-peanut-butter-fudge-ice-cream/
+ chocolate sprinkles: https://www.seriouseats.com/images/2017/08/20170811-chocolate-sprinkles-vicky-wasik-1.jpg
+ hot-fudge: https://prettysimplesweet.com/wp-content/uploads/2017/07/HotFudgeSauce.jpg
+ rainbow-sprinkles: https://www.flickr.com/photos/12355559@N03/41980198192
+ chocolate syrup: https://pics.drugstore.com/prodimg/413338/900.jpg
+ marshmallow: https://iambaker.net/wp-content/uploads/2017/06/550SQUARE-marshmallow-sauce.jpg
+ banana: https://www.tasteofhome.com/wp-content/uploads/2017/10/exps36127_TH1195008D10-1.jpg
+ pineapple: http://cooklikeyourgrandmother.com/how-to-make-fried-pineapple-ice-cream-topping/
+ strawberry: https://www.tastesoflizzyt.com/wp-content/uploads/2015/05/Homemade-Strawberry-Topping-Recipe-5.jpg
+ reeses: https://sep.yimg.com/ay/blaircandy/reese-s-peanut-butter-cup-chopped-topping-5lb-bag-50.jpg
+ whipped cream: https://thetoughcookie.com/2016/07/27/super-smooth-whipped-cream-frosting-step-by-step/
+ chocolate-chips: https://nuts.com/images/auto/510x340/assets/ab227483912bb2d2.jpg

## Code style divergences
None that I know of but may have missed on accident.