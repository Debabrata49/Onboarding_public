<template>
    <div class="not-found">
      <h1>404 - Page Not Found</h1>
      <p>Sorry, the page you're looking for doesn't exist.</p>
      <img
        src="https://i.imgur.com/qIufhof.png"
        alt="404 Not Found"
        class="not-found-image"
      />
    </div>
  </template>
  
  <script>
  export default {
    name: "NotFound",
  };
  </script>
  
  <style scoped>
  .not-found {
    text-align: center;
    padding: 50px;
  }
  
  .not-found h1 {
    font-size: 2.5em;
    color: #ff5f5f;
  }
  
  .not-found p {
    font-size: 1.5em;
    margin-bottom: 20px;
  }
  
  .not-found-image {
    max-width: 100%;
    height: auto;
    margin-top: 20px;
  }
  </style>
  