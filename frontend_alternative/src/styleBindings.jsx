// Style reuse through string bindings
// JSX is used for Prettier tailwind class sorting

export const formInputStyle = (
  <input
    class={'block w-96 rounded-lg border-2 border-blue-400 text-sm'}
  ></input>
).props.class;

export const formSubmitButtonStyle = (
  <button
    class={
      'font-small mb-2 mr-2 rounded-lg bg-blue-600 px-7 py-0.5 text-sm text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
    }
  ></button>
).props.class;

export const formCheckboxStyle = (
  <input
    class={
      'h-5 w-5 rounded border-2 border-blue-400 bg-gray-100 text-blue-600 focus:ring-blue-500'
    }
  ></input>
).props.class;

export const optionButtonDarkStyle = (
  <button
    class={
      'font-small float-right mr-2 mb-2 rounded-lg bg-blue-600 px-4 py-0.5 align-[2px] text-xs font-light text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
    }
  ></button>
).props.class;

export const optionButtonLightStyle = (
  <button
    class={
      'font-small float-right mr-2 mb-2 rounded-lg bg-blue-400 px-4 py-0.5 align-[2px] text-xs font-light text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
    }
  ></button>
).props.class;

export const frameShadowStyle =
  (<div class={'mr-3 mb-3 rounded-lg bg-transparent py-2 px-3'}></div>).props
    .class + ' item-shadow'; // from @/css/tree.css
