const calendar = {
  currentDate: new Date(),
  selectedDate: new Date(),
  currentWeekStart: new Date(),

  monthNames: [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
  ],
  dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],

  init() {
    console.log('🔧 Inicializando calendario...');

    // Elementos principales
    this.monthTitle = document.querySelector('.titulo-mes');
    this.calendarGrid = document.querySelector('.grilla-calendario');

    this.monthTitleMobile = document.getElementById('mes-actual-mobile');
    this.horizontalCalendar = document.getElementById('calendario-horizontal');

    // Botones de navegación
    document.getElementById('btn-prev')?.addEventListener('click', () => this.prevWeek());
    document.getElementById('btn-next')?.addEventListener('click', () => this.nextWeek());
    document.getElementById('btn-prev-month')?.addEventListener('click', () => this.prevMonth());
    document.getElementById('btn-next-month')?.addEventListener('click', () => this.nextMonth());

    this.currentWeekStart = this.getStartOfWeek(this.selectedDate);

    this.renderMonth();
    this.renderHorizontalCalendar();
  },

  // === Helpers ===
  getStartOfWeek(date) {
    const d = new Date(date);
    const day = d.getDay();
    const diff = d.getDate() - day + (day === 0 ? -6 : 1);
    return new Date(d.setDate(diff));
  },
  getDaysInMonth(date) {
    return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
  },
  getFirstDayOfMonth(date) {
    const day = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    return day === 0 ? 6 : day - 1;
  },
  isToday(date) {
    const today = new Date();
    return date.toDateString() === today.toDateString();
  },
  isSelected(date) {
    return date.toDateString() === this.selectedDate.toDateString();
  },

  // === Seleccionar fecha centralizada ===
  selectDate(date) {
    this.selectedDate = new Date(date);
    this.currentWeekStart = this.getStartOfWeek(this.selectedDate);
    this.currentDate = new Date(this.selectedDate); // sincroniza el mes
    this.renderMonth();
    this.renderHorizontalCalendar();

    // Llamar callback si existe (para actualizar reservas)
    if (typeof llamarReservas === 'function') {
      llamarReservas();
    }
  },

  // === Navegación semanal ===
  prevWeek() {
    this.currentWeekStart.setDate(this.currentWeekStart.getDate() - 7);
    this.selectedDate = new Date(this.currentWeekStart);
    this.currentDate = new Date(this.selectedDate);
    this.renderMonth();
    this.renderHorizontalCalendar();
  },
  nextWeek() {
    this.currentWeekStart.setDate(this.currentWeekStart.getDate() + 7);
    this.selectedDate = new Date(this.currentWeekStart);
    this.currentDate = new Date(this.selectedDate);
    this.renderMonth();
    this.renderHorizontalCalendar();
  },

  // === Navegación mensual ===
  prevMonth() {
    this.currentDate.setMonth(this.currentDate.getMonth() - 1);
    this.selectedDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), this.selectedDate.getDate());
    this.currentWeekStart = this.getStartOfWeek(this.selectedDate);
    this.renderMonth();
    this.renderHorizontalCalendar();
  },
  nextMonth() {
    this.currentDate.setMonth(this.currentDate.getMonth() + 1);
    this.selectedDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), this.selectedDate.getDate());
    this.currentWeekStart = this.getStartOfWeek(this.selectedDate);
    this.renderMonth();
    this.renderHorizontalCalendar();
  },

  // === Render mensual (escritorio) ===
  renderMonth() {
    if (!this.calendarGrid) return;

    const year = this.currentDate.getFullYear();
    const month = this.currentDate.getMonth();
    const daysInMonth = this.getDaysInMonth(this.currentDate);
    const firstDay = this.getFirstDayOfMonth(this.currentDate);

    // Actualizar título
    if (this.monthTitle)
      this.monthTitle.textContent = `${this.monthNames[month]} ${year}`;

    let html = '';
    const totalCells = 42; // 6 semanas

    // Días del mes anterior
    const prevMonthDate = new Date(year, month, 0);
    const daysInPrevMonth = prevMonthDate.getDate();
    for (let i = firstDay - 1; i >= 0; i--) {
      const day = daysInPrevMonth - i;
      const date = new Date(year, month - 1, day);
      html += this.createDayButton(date, false);
    }

    // Días del mes actual
    for (let day = 1; day <= daysInMonth; day++) {
      const date = new Date(year, month, day);
      html += this.createDayButton(date, true);
    }

    // Días del mes siguiente
    const remaining = totalCells - (firstDay + daysInMonth);
    for (let day = 1; day <= remaining; day++) {
      const date = new Date(year, month + 1, day);
      html += this.createDayButton(date, false);
    }

    this.calendarGrid.innerHTML = html;

    // Click en día
    this.calendarGrid.querySelectorAll('button').forEach(btn => {
      btn.addEventListener('click', () => {
        const [year, month, day] = btn.dataset.date.split('-');
        this.selectDate(new Date(year, month - 1, day));
      });
    });
  },

  // === Render semanal (móvil tipo carrusel) ===
  renderHorizontalCalendar() {
    if (!this.horizontalCalendar) return;

    const diasSemana = [];
    for (let i = 0; i < 7; i++) {
      const d = new Date(this.currentWeekStart);
      d.setDate(this.currentWeekStart.getDate() + i);
      diasSemana.push(d);
    }

    // Actualizar título móvil
    if (this.monthTitleMobile) {
      const mes = this.monthNames[this.currentWeekStart.getMonth()];
      const año = this.currentWeekStart.getFullYear();
      this.monthTitleMobile.textContent = `${mes} ${año}`;
    }

    // Crear botones
    const fragment = document.createDocumentFragment();
    diasSemana.forEach(date => {
      const btn = document.createElement('button');
      const isToday = this.isToday(date);
      const isSelected = this.isSelected(date);

      // Formatear fecha en YYYY-MM-DD
      const dateStr = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
      btn.dataset.date = dateStr;

      btn.className =
        'dia flex flex-col items-center justify-center border border-base-content/10 rounded-lg px-3 py-2 text-sm transition-all duration-200 snap-center ' +
        (isSelected
          ? 'bg-indigo-600 text-white scale-105 active'
          : isToday
            ? 'bg-indigo-600/10 text-indigo-500'
            : 'bg-base-100 text-base-content hover:bg-base-content/10');

      btn.innerHTML = `
        <span class="text-xs font-medium">${this.dayNamesShort[date.getDay()]}</span>
        <span class="font-bold">${date.getDate()}</span>
      `;

      btn.addEventListener('click', () => {
        const [year, month, day] = btn.dataset.date.split('-');
        this.selectDate(new Date(year, month - 1, day));
      });

      fragment.appendChild(btn);
    });

    this.horizontalCalendar.innerHTML = '';
    this.horizontalCalendar.appendChild(fragment);

    // Scroll suave y centrado
    this.centerSelectedDay();
  },

  // === Centrar día seleccionado ===
  centerSelectedDay() {
    if (!this.horizontalCalendar) return;
    const selected = this.horizontalCalendar.querySelector(
      'button.bg-indigo-600'
    );
    if (!selected) return;

    const containerWidth = this.horizontalCalendar.offsetWidth;
    const offset = selected.offsetLeft - containerWidth / 2 + selected.offsetWidth / 2;

    this.horizontalCalendar.scrollTo({
      left: offset,
      behavior: 'smooth'
    });
  },

  // === Crear botón de día (para el mes) ===
  createDayButton(date, isCurrentMonth) {
    const isToday = this.isToday(date);
    const isSelected = this.isSelected(date);
    const classes = `
      dia bg-base-100 w-full p-2 text-sm transition-all duration-200 aspect-1/1 hover:bg-indigo-500/20
      ${isSelected ? 'active bg-indigo-500/80 text-white' :
        isToday ? 'text-indigo-500 border-indigo-500 font-semibold' :
          isCurrentMonth ? 'bg-base-100 text-base-content' :
            'opacity-50 text-base-content'}
    `;

    const dateStr = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;

    return `
      <button class="${classes}" data-date="${dateStr}">
        ${date.getDate()}
      </button>
    `;
  }

};

// Inicializar
document.addEventListener('DOMContentLoaded', () => calendar.init());
