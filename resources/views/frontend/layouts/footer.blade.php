<div class="content">
    <div class="row" style="padding-bottom: 10px;">
        <div class="col-md-6">
            <div class="contact-us">
                <h3 class="header-text"><span>ទំនាក់ទំនង</span></h3>
                <ul>
                    <li><i class="fa fa-home"></i>ផ្ទះលេខ២B, ផ្លូវសហព័ន្ធរុស្ស៊ី, សង្កាត់ ទឹកថ្លា, ខណ្ឌ សែនសុខ, ភ្នំពេញ</li>
                    <li><i class="fa fa-phone-square"></i>(+855) 93 723 371 - 69 929 678</li>
                    <li><i class="fa fa-envelope"></i><a href="mailto:info@tumporkhmer.com">info@tumporkhmer.com</a></li>
                    <li><i class="fa fa-bookmark"></i><a href="{{route('Advertisement')}}">ផ្សាយពាណិជ្ជកម្ម</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
           <div class="menu-bottom">
            <h3 class="header-text"><span>មាតិកា</span></h3>
                <ul>
                    @foreach($menus as $menu)
                        <li>
                            <a href="{{route('getArticleByCate' ,$menu->slug)}}">{{$menu->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="social">
                    <h3><span>ជួបគ្នានៅបណ្ដាញសង្គម</span></h3>
                    <ul>
                        <li>
                            <a href="">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-youtube-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-twitter-square"></i>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="footer-bottom">
            <div class="col-md-6">
               <p>
                &copy; រក្សា​សិទ្ធិ​គ្រប់​យ៉ាង​ដោយ​ TUMPORKHMER ឆ្នាំ ​{{str_replace($num_en, $num_kh, date('Y'))}}
               </p>
            </div>
            <div class="col-md-6">
               <p style="text-align: right;">
                    Developed by : <a href="https://www.facebook.com/camwebsolutions/" target="_blank"> CAM WEB SOLUTION </a>
               </p>
            </div>
        </div>
    </div>
</div>