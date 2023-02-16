<?php include('header.php');?>


        <div class="container">
            <div class="row">
                
                <div class="col-sm-4 ">  
                    <div class="card" style="width: 18rem;">
                        <img src="./images/test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        <input type="hidden" name="key" value="t1">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-4 ">  
                    <div class="card" style="width: 18rem;">
                        <img src="./images/test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        <input type="hidden" name="key" value="t2">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-4">  
                    <div class="card" style="width: 18rem;">
                        <img src="./images/test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">  
                    <div class="card" style="width: 18rem;">
                        <img src="./images/test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">  
                    <div class="card" style="width: 18rem;">
                        <img src="./images/test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">  
                    <div class="card" style="width: 18rem;">
                        <img src="./images/test.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

          
                
            </div> <!-- end row class-->
        </div> <!-- end container-->
    <script>
       var ele = document.getElementsByClassName("col-sm-4");
       for(let i=0;i<ele.length;i++)
       {
           ele[i].addEventListener('mouseover',(e)=>{
                if(!ele[i].classList.contains('hov'))
                {
                    ele[i].className +=' hov';
                    let card = ele[i].getElementsByClassName('card')[0];        
                    var img = card.getElementsByTagName('img')[0];
                    img.setAttribute('src','./images/test_gif.gif'); 
                    img.setAttribute('height','150px');
                }else{
                 
                }
           });
       }
       
       for(let i=0;i<ele.length;i++)
       {
           ele[i].addEventListener('mouseout',(e)=>{
            if(ele[i].classList.contains('hov'))
            {
                ele[i].classList.remove('hov');
                let card = ele[i].getElementsByClassName('card')[0];
                let img  = card.getElementsByTagName('img')[0];
                img.setAttribute('src','./images/test.jpg');
                img.removeAttribute('height');
            }});
       }
       
    </script>
</body>
</html>