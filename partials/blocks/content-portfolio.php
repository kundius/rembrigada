<?php if ($list = get_field('content-portfolio')): ?>
<div class="wp-block-content-portfolio">
  <?php foreach($list as $item): the_field('seo_title', 2767); ?>
  <div class="works-item">
      <div class="works-item__title"><?php echo $item->post_title ?></div>
      <div class="works-item__grid">
          <div class="works-item__cell">
              <?php if ($gallery = get_field('gallery', 'project_' . $item->ID)): ?>
              <div class="works-item-images<?php if (count($gallery) == 1): ?> works-item-images_single<?php endif; ?>">
                  <?php foreach (array_splice($gallery, 0, 8) as $key => $item): ?>
                  <div class="works-item-image">
                      <a href="<?php echo $item['sizes']['large'] ?>" data-fslightbox="project-<?php echo 'project_' . $item->ID ?>" class="works-item-image__wrapper">
                          <span class="works-item-image__inner" style="background-image: url('<?php echo $item['sizes'][$key == 0 ? 'w800h600' : 'w150h100'] ?>')"></span>
                          <span class="works-item-image__loupe"><?php icon('loupe') ?></span>
                      </a>
                  </div>
                  <?php endforeach; ?>
              </div>
              <?php endif; ?>
          </div>
          <div class="works-item__cell">
              <?php if ($address = get_field('address', 'project_' . $item->ID)): ?>
              <div class="works-item-object">
                  <div class="works-item-object__label">
                      Объект:
                  </div>
                  <div class="works-item-object__value">
                      <?php echo $address ?>
                  </div>
              </div>
              <?php endif; ?>
              <div class="works-item-info">
                  <!-- <div class="works-item-info__title">
                      Особенности проекта:
                  </div> -->
                  <?php if ($area = get_field('area', 'project_' . $item->ID)): ?>
                  <div class="works-item-info__row">
                      <div class="works-item-info__label">
                          Площадь:
                      </div>
                      <div class="works-item-info__area">
                          <?php echo $area ?> <span>м<sup>2</sup></span>
                      </div>
                  </div>
                  <?php endif; ?>
              </div>
              <?php if ($time_works = get_field('time_works', 'project_' . $item->ID)): ?>
              <div class="works-item-deadline">
                  <div class="works-item-deadline__label">
                      Сроки:
                  </div>
                  <div class="works-item-deadline__value">
                      <?php echo $time_works ?>
                  </div>
              </div>
              <?php endif; ?>
              <div class="works-item-pricing">
                  <?php if (get_field('price_works', 'project_' . $item->ID) || get_field('price_material', 'project_' . $item->ID)): ?>
                      <div class="works-item-pricing__title">Стоимость:</div>
                  <?php endif; ?>
                  <div class="works-item-pricing__text">
                      <?php if ($price_works = get_field('price_works', 'project_' . $item->ID)): ?>
                      <div>Ремонтные работы: <strong><?php echo $price_works ?> руб.</strong></div>
                      <?php endif; ?>
                      <?php if ($price_material = get_field('price_material', 'project_' . $item->ID)): ?>
                      <div>Черновые материалы с доставкой: <strong><?php echo $price_material ?> руб.</strong></div>
                      <?php endif; ?>
                  </div>
                  <a href="#callback" class="works-item-pricing__button"><span>Рассчитать стоимость своего ремонта</span></a>
              </div>
          </div>
      </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>
