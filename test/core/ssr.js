import Vue from 'vue'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'


const accordionComponent = require.context("./accordion", false, /\.vue$/);
accordionComponent.keys().forEach(fileName => {
  const componentConfig = accordionComponent(fileName)
  const componentName = upperFirst(camelCase(fileName.split('/').pop().replace(/\.\w+$/, '')))
  Vue.component(componentName, componentConfig.default || componentConfig)
});

const imagesComponent = require.context("./images", false, /\.vue$/);
imagesComponent.keys().forEach(fileName => {
  const componentConfig = imagesComponent(fileName)
  const componentName = upperFirst(camelCase(fileName.split('/').pop().replace(/\.\w+$/, '')))
  Vue.component(componentName, componentConfig.default || componentConfig)
});

const widgetsComponent = require.context("./widgets", false, /\.vue$/);
widgetsComponent.keys().forEach(fileName => {
  const componentConfig = widgetsComponent(fileName)
  const componentName = upperFirst(camelCase(fileName.split('/').pop().replace(/\.\w+$/, '')))
  Vue.component(componentName, componentConfig.default || componentConfig)
});