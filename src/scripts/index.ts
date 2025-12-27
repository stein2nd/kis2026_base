import '../styles/style.scss';

document.addEventListener('DOMContentLoaded', () => {
  let is_pc: boolean = true;
  const loc: string = location.href;

  /**
   * UA を判断する
   */
  const _ua = (function (u: string) {
    return {
      Tablet:
        (u.indexOf('windows') !== -1 && u.indexOf('touch') !== -1) ||
        u.indexOf('ipad') !== -1 ||
        (u.indexOf('android') !== -1 && u.indexOf('mobile') === -1) ||
        (u.indexOf('firefox') !== -1 && u.indexOf('tablet') !== -1) ||
        u.indexOf('kindle') !== -1 ||
        u.indexOf('silk') !== -1 ||
        u.indexOf('playbook') !== -1,
      Mobile:
        (u.indexOf('windows') !== -1 && u.indexOf('phone') !== -1) ||
        u.indexOf('iphone') !== -1 ||
        u.indexOf('ipod') !== -1 ||
        (u.indexOf('android') !== -1 && u.indexOf('mobile') !== -1) ||
        (u.indexOf('firefox') !== -1 && u.indexOf('mobile') !== -1) ||
        u.indexOf('blackberry') !== -1,
    };
  })(window.navigator.userAgent.toLowerCase());

  /**
   * 電話番号のリンクをクリックしたときに、リンク先に遷移しないようにする
   */
  if (!_ua.Mobile) {
    document.querySelectorAll('a[href^="tel:"]').forEach((link) => {
      link.classList.add('resetAStyle');
      link.addEventListener('click', function (e) {
        e.preventDefault();
      });
    });
  }

  /**
   * viewport の設定
   */
  if (window.innerWidth > 640) {
    document.querySelector('meta[name="viewport"]')?.setAttribute('content', 'width=1100');
  }

  /**
   * PC か Mobile かを判断する
   */
  const pcElement = document.querySelector('.pc');
  if (pcElement && window.getComputedStyle(pcElement).display === 'none') {
    is_pc = false;
  }

  /**
   * checkbox のラベルをクリックしたときに、checkbox をチェックする
   */
  document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
    if ((checkbox as HTMLInputElement).checked) {
      checkbox.insertAdjacentHTML(
        'beforebegin',
        '<div class="wrapInput wrapInput--checked wrapInput--checkbox"></div>'
      );
    } else {
      checkbox.insertAdjacentHTML(
        'beforebegin',
        '<div class="wrapInput wrapInput--checkbox"></div>'
      );
    }
  });

  /**
   * checkbox のラベルをクリックしたときに、checkbox をチェックする
   */
  document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
    checkbox.addEventListener('change', function (this: HTMLInputElement) {
      if (this.getAttribute('type') === 'radio') {
        const groupName = this.getAttribute('name');
        document.querySelectorAll(`input[name="${groupName}"]`).forEach((groupCheckbox) => {
          groupCheckbox.closest('.wrapInput')?.classList.remove('wrapInput--checked');
        });
      }
      if (this.checked) {
        this.closest('li')?.classList.add('checked');
        this.closest('.wrapInput')?.classList.add('wrapInput--checked');
      } else {
        this.closest('li')?.classList.remove('checked');
        this.closest('.wrapInput')?.classList.remove('wrapInput--checked');
      }
    });
  });

  /**
   * リンクをクリックしたときに、リンク先に遷移しないようにする
   */
  document.querySelectorAll('a:not(.noScroll)').forEach((link) => {
    link.addEventListener('click', function (this: HTMLAnchorElement, e) {
      const href = this.getAttribute('href');
      let k = 0;
      const targetElement = href ? document.querySelector(href) : null;
      if (href?.match(/^#/) && targetElement) {
        e.preventDefault();
        const pcElement = document.querySelector('.pc');
        if (pcElement && window.getComputedStyle(pcElement).display === 'none') {
          // 3.4375rem (55px) をピクセルに変換
          const rootFontSize = parseFloat(
            window.getComputedStyle(document.documentElement).fontSize
          );
          k = 3.4375 * rootFontSize;
        }
        const rect = targetElement.getBoundingClientRect();
        window.scrollTo({
          top: rect.top + window.scrollY - k,
          behavior: 'smooth',
        });
      }
    });
  });

  /**
   * ナビゲーション・メニューをクリックしたときに、ナビゲーション・メニューを開く
   */
  document.querySelectorAll('.toggleNav').forEach((toggleNav) => {
    let touchStartTime = 0;

    const handleToggleNav = function (e: Event) {
      e.preventDefault();
      e.stopPropagation();
      const siteHeader = document.querySelector('.siteHeader');
      const navMain = document.querySelector('.navMain');
      
      if (siteHeader) {
        siteHeader.classList.toggle('open');
      }
      (toggleNav as HTMLElement).classList.toggle('open');
      if (navMain) {
        navMain.classList.toggle('slideToggle');
      }
    };

    // モバイルデバイスでのタッチイベントに対応
    toggleNav.addEventListener('touchstart', function (e: Event) {
      touchStartTime = Date.now();
      handleToggleNav(e);
    }, { passive: false });

    // PCでのクリックイベントに対応
    toggleNav.addEventListener('click', function (e: Event) {
      const timeSinceTouch = Date.now() - touchStartTime;
      // touchstartから300ms以内のclickは無視（モバイルでの重複を防ぐ）
      if (touchStartTime === 0 || timeSinceTouch > 300) {
        handleToggleNav(e);
      }
      // フラグをリセット
      touchStartTime = 0;
    });
  });

  /**
   * ナビゲーション・メニューを閉じる
   */
  document.querySelector('.navMain__closeButton')?.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.toggleNav')?.dispatchEvent(new Event('click'));
  });

  /**
   * ナビゲーション・メニューのリンクをクリックしたときに、ナビゲーション・メニューのリンクをアクティブにする
   */
  document.querySelectorAll('.navMain a').forEach((link) => {
    if (loc.indexOf(link.getAttribute('href') || '') !== -1) {
      link.classList.add('current');
    }
  });

  /**
   * アコーディオンをクリックしたときに、アコーディオンを開く
   */
  document.querySelectorAll('.accordion__trigger').forEach((trigger) => {
    trigger.addEventListener('click', function (this: HTMLElement, e) {
      e.preventDefault();
      this.classList.toggle('active');
      this.closest('.accordion')
        ?.querySelector('.accordion__target')
        ?.classList.toggle('slideToggle');
    });
  });

  /**
   * PC の場合は、ナビゲーション・メニューのリンクをホバーしたときに、ナビゲーション・メニューを表示する
   */
  if (is_pc) {
    document.querySelectorAll('.navMain > ul > li').forEach((li) => {
      li.addEventListener('mouseenter', function (this: HTMLLIElement) {
        if (is_pc) {
          this.querySelector('ul')?.classList.add('show');
          this.classList.add('on');
        }
      });
      li.addEventListener('mouseleave', function (this: HTMLLIElement) {
        if (is_pc) {
          this.querySelector('ul')?.classList.remove('show');
          this.classList.remove('on');
        }
      });
    });
  }
});
