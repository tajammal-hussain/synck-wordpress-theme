<?php
    /**
     * The blog template file.
     *
     * @package          Synck\Templates
     * @Synck-version 1.0.0
     */

    get_header();
    global $post;
?>
<?php
    $banner = get_field('banner', $post->ID);
    if($banner):
?>
<section class="hero-empowerment-area">
   <div class="custom-container">
      <div class="custom-row align-items-center">
         <div class="hero-empowerment-left-content">
            <?php echo isset( $banner['content']) ?  $banner['content'] : ''; ?>
            <div class="btns-group d-flex">
            <?php if(isset($banner['learnmore']) || isset($banner['learnmorekurl'])): ?>
               <a href="<?php echo $banner['learnmorekurl']; ?>" class="theme-btn"><?php echo $banner['learnmore']; ?></a>
            <?php endif; ?>
            <?php if(isset($banner['letstalkurl']) || isset($banner['letstalk'])): ?>
               <a href="<?php echo $banner['letstalkurl']; ?>" class="theme-btn2"><?php echo $banner['letstalk']; ?>
               <i class="iconoir-arrow-up-right"></i>
               </a>
            <?php endif; ?>
            </div>
         </div>
         <div class="hero-empowerment-right-content">
            <div class="top-content">
               <?php echo isset($banner['banner']) ?  '<img class="desktop fade-in" src="'.wp_get_attachment_url($banner['banner']).'" alt="Empowerment">': ''; ?>
               <?php if(isset($banner['experience'])) :?>
                <div class="experience-box simple-shadow bounce-in">
                    <div class="experience-body d-flex align-items-center">
                         <?php echo isset($banner['experience']['experienceimage']) ?  '<img  src="'.wp_get_attachment_url($banner['experience']['experienceimage']).'" alt="Empowerment">': ''; ?>                           
                          <div class="experience-content d-flex align-items-center">
                          <?php echo isset($banner['experience']['experiencenumber']) ?  '<h1>+'.$banner['experience']['experiencenumber'].'</h1>': ''; ?>                           
                          <?php echo isset($banner['experience']['experiencecontent']) ?  $banner['experience']['experiencecontent']: ''; ?>                           
                        </div>
                    </div>
                </div>
               <?php endif; ?>
            </div>
            <div class="bottom-content d-flex">
                <?php if(isset($banner['experts'])) : ?>
               <a href="./team.html" class="our-expert-team-box simple-shadow bounce-in delay-2">
                  <div class="our-expert-team-box-inner d-flex align-items-center">
                    <?php if(isset($banner['experts']['image'])): ?>
                     <div class="imgs imgs1 d-flex align-items-center">
                        <?php foreach($banner['experts']['image'] as $img) : ?>
                            <img src="<?php echo wp_get_attachment_url($img['expertimage']); ?>" alt="team" />
                        <?php endforeach; ?>
                     </div>
                    <?php endif; ?>
                    <?php echo isset($banner['experts']['expertcontent']) ?  $banner['experts']['expertcontent']: ''; ?>                           
                  </div>
               </a>
               <?php endif; ?>
               <div class="google-reviews-box simple-shadow bounce-in delay-3">
                  <div class="left">
                     <span>Verified by</span>
                     <img src="./assets/imgs/icon2.svg" alt="Google">
                  </div>
                  <div class="right">
                     <div class="stars d-flex align-items-center">
                        <i class="las la-star"></i>
                        <i class="las la-star"></i>
                        <i class="las la-star"></i>
                        <i class="las la-star"></i>
                        <i class="las la-star"></i>
                     </div>
                     <p>
                        3245
                        <span>Reviews</span>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>
