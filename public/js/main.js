$(document).ready(function () {
  window._token = $('meta[name="csrf-token"]').attr('content')

  let locale = window.appLocale || 'en';

  if (locale === 'id') {
    moment.updateLocale('id', {
      week: {dow: 1} // Monday is the first day of the week
    })
  }

  if ($.fn.dataTable && locale === 'id' && window.dtIndonesian) {
    $.extend(true, $.fn.dataTable.defaults, {
      language: window.dtIndonesian
    });
  }

  $('.date').datetimepicker({
    format: 'YYYY-MM-DD',
    locale: locale,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.datetime').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    locale: locale,
    sideBySide: true,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.timepicker').datetimepicker({
    format: 'HH:mm:ss',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

  $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', true)
    $select2.trigger('change')
  })
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', false)
    $select2.trigger('change')
  })

  $('.select2').select2({
    language: (locale === 'id' && window.select2Indonesian) ? window.select2Indonesian : {}
  })

  $('.treeview').each(function () {
    if ($(this).find('li.active').length) {
      $(this).addClass('active')
    }
  })

$('button.sidebar-toggler').click(function () {
    // Menggunakan event transitionend agar lebih akurat daripada setTimeout
    $('.sidebar').one('transitionend', function() {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
    // Fallback jika browser tidak mendukung atau tidak ada transisi
    setTimeout(function() { $($.fn.dataTable.tables(true)).DataTable().columns.adjust(); }, 300);
  })
})
