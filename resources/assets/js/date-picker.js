function LGDatePicker(dataField, jsDateFormat, dateFormat, locale, dateFrom, dateTo) {
  return {
    dataField: dataField,
    dateFrom: dateFrom,
    dateTo: dateTo,
    element: null,

    init() {
      window.addEventListener(`LGdatePickerClear`, () => {
        if (this.$refs.datePicker && this.element) {
          this.element.clear()
        }
      })

      if (this.$refs && this.$refs.datePicker) {
        this.element = flatpickr(this.$refs.datePicker, this.getOptions());
      }
    },

    getOptions() {
      return {
        mode: 'range',
        defaultHour: 0,
        defaultDate: [this.dateFrom, this.dateTo],
        dateFormat: dateFormat,
        locale: locale,
        onClose: function (selectedDates) {
          if (selectedDates.length === 2) {
            let elementFrom = document.querySelector(`input[name="filter.${dataField}.from"]`);
            let elementTo = document.querySelector(`input[name="filter.${dataField}.to"]`);

            elementFrom.value = dayjs(selectedDates[0], 'Y-MM-DD').format(jsDateFormat);
            elementTo.value = dayjs(selectedDates[1], 'Y-MM-DD').format(jsDateFormat);

            elementFrom.dispatchEvent(new Event('input'));
            elementTo.dispatchEvent(new Event('input'));
          }
        }
      };
    }
  }
}