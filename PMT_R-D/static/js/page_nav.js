function slider() {
    const cards = document.querySelectorAll('.card');
    const currentCard = document.querySelector('.card:first-child');
    setInterval(() => {
      const nextCard = currentCard.nextElementSibling || cards[0];
      currentCard.style.opacity = 0;
      nextCard.style.opacity = 1;
      currentCard.classList.remove('active');
      nextCard.classList.add('active');
      currentCard = nextCard;
    }, 5000);
  }