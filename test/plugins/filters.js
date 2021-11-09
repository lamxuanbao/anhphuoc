import Vue from 'vue'
import _ from "lodash";

Vue.filter('mergeObject', function (obj1, obj2) {
  return _.pick(_.defaults(obj2, obj1), _.keys(obj1));
})
Vue.filter('data', function (obj) {
  return _.reduce(obj, function (result, value, key) {
    if (_.isBoolean(value)) {
      result[key] = value;
    } else if (!_.isEmpty(value)) {
      result[key] = value;
    }
    return result;
  }, {});
})
Vue.filter('formatDate', function (date, locale = 'vi') {
  return date;
})
Vue.filter('convertMoney', function (value, currency_from, currency_to) {
  if (currency_from !== currency_to) {
    let code = currency_to + '_to_' + currency_from;
    if (typeof (window.config[code.toLowerCase()]) == "undefined" || window.config[code.toLowerCase()] == null) {
      code = currency_from + '_to_' + currency_to;
    }
    const exchange_value = window.config[code.toLowerCase()] || 1;

    if ((currency_from === 'VND' && currency_to === 'JPY') || (currency_from === 'VND' && currency_to === 'USD')) {
      value = value / exchange_value;
    } else {
      value = value * exchange_value;
    }
  }

  let locale = 'en';
  if (currency_to === 'VND') {
    locale = 'vi';
  }
  let moneyFormat = new Intl.NumberFormat(locale, {
    style: 'currency',
    currency: currency_to,
  });
  return moneyFormat.format(value);
})
Vue.filter('convertJsonToFormData', function (data) {
  const formData = new FormData()
  const entries = Object.entries(data) // returns array of object property as [key, value]
  // https://medium.com/front-end-weekly/3-things-you-didnt-know-about-the-foreach-loop-in-js-ff02cec465b1

  for (let i = 0; i < entries.length; i++) {
    // don't try to be smart by replacing it with entries.each, it has drawbacks
    const arKey = entries[i][0]
    let arVal = entries[i][1]
    if (typeof arVal === 'boolean') {
      arVal = arVal === true ? 1 : 0
    }
    if (Array.isArray(arVal)) {

      if (arVal[0] instanceof File) {
        for (let z = 0; z < arVal.length; z++) {
          formData.append(`${arKey}[]`, arVal[z])
        }

        continue // we don't need to append current element now, as its elements already appended
      } else if (arVal[0] instanceof Object) {
        for (let j = 0; j < arVal.length; j++) {
          if (arVal[j] instanceof Object) {
            // if first element is not file, we know its not files array
            for (const prop in arVal[j]) {
              if (Object.prototype.hasOwnProperty.call(arVal[j], prop)) {
                // do stuff
                if (!isNaN(Date.parse(arVal[j][prop]))) {
                  // console.log('Valid Date \n')
                  // (new Date(fromDate)).toUTCString()
                  formData.append(
                    `${arKey}[${j}][${prop}]`,
                    new Date(arVal[j][prop])
                  )
                } else {
                  formData.append(`${arKey}[${j}][${prop}]`, arVal[j][prop])
                }
              }
            }
          }
        }
        continue // we don't need to append current element now, as its elements already appended
      } else {
        arVal = JSON.stringify(arVal)
      }
    }

    if (arVal === null) {
      continue
    }
    formData.append(arKey, arVal)
  }
  return formData
})