<style>
  /* SVG loader made by: csozi | Website: www.csozi.hu*/
  .loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #f4f4f4;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: visibility 0s, opacity 0.5s linear;
    }

  .loader {
    overflow: visible;
    height: fit-content;
    width: fit-content;
    padding: 20px;
    display: flex;
  }

  .logo {
    fill: none;
    stroke-dasharray: 30px;
  /*<-- Play with this number until it look cool */
    stroke: #687c2a;
    stroke-width: 1.1px;
    animation: load 15s infinite linear;
  }

  @keyframes load {
    0% {
      stroke-dashoffset: 0px;
    }

    100% {
      stroke-dashoffset: 250px;
  /* <-- This number should always be 10 times the number up there*/
    }
  }
</style>
<div class="loading-screen">
  <div class="loader">
    <svg class="logo" xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor" viewBox="0 0 64 64"><path d="M6.75 11.482c0 .405.33.75.75.75s.75-.345.75-.75v-.855c0-.42-.33-.75-.75-.75s-.75.33-.75.75z"/><path d="M24.62 5a5.506 5.506 0 0 0-5.57 4.72c-.02.15.1.28.25.28h.26c.76 0 1.48-.42 1.83-1.1c.6-1.18 1.85-1.97 3.28-1.9c1.78.08 3.23 1.52 3.33 3.31a3.503 3.503 0 0 1-1.084 2.722a5.202 5.202 0 0 0-4.578-2.014l-6.82.84h-.006a.87.87 0 0 1-.437-.034a.678.678 0 0 1-.254-.182a1.386 1.386 0 0 1-.162-.218l.004-.016l.659-2.622v-.001A2.238 2.238 0 0 0 13.152 6H9.02A4.871 4.871 0 0 0 4.3 9.687L4.222 10H2.76A1.76 1.76 0 0 0 1 11.76V12a3.99 3.99 0 0 0 1.504 3.128a1.357 1.357 0 0 0-.004.11v.512c0 .686.564 1.25 1.25 1.25c.6 0 1.108-.432 1.225-1H6v1.19c0 1.759.599 3.452 1.683 4.81A3.704 3.704 0 0 0 4 25.71v.67c0 .903.738 1.62 1.63 1.62h1.75c.673 0 1.252-.414 1.496-1h.294a3.82 3.82 0 0 0 3.806-3.393L14 29.74c.03.15.16.26.31.26h2.44c.15 0 .27-.14.25-.29L15.875 23h2.965c.225 0 .449-.012.67-.036L18 29.69c-.04.16.08.3.24.3h2.44c.15 0 .27-.1.3-.24l1.023-4.44c.287.221.614.41.986.559h.002l2.019.808v2.013c0 .722.588 1.31 1.31 1.31h2.38c.722 0 1.31-.588 1.31-1.31v-4.87a2.607 2.607 0 0 0-1.14-2.11l-.87-.579V16.22c0-.463-.06-.912-.173-1.339A5.485 5.485 0 0 0 30 10.341c-.08-2.91-2.47-5.28-5.38-5.34M6.24 10.172a2.873 2.873 0 0 1 2.434-2.151l.629 3.363l.008.03a2.765 2.765 0 0 0 4.128 1.675c.528.526 1.298.885 2.326.753h.003l6.79-.837A3.218 3.218 0 0 1 26 16.22v5.28c0 .45.232.863.593 1.097l1.158.772l.002.001a.61.61 0 0 1 .257.482V28h-1v-1.79c0-.57-.357-1.022-.815-1.213l-.014-.006l-2.45-.98h-.002c-.896-.356-1.398-1.246-1.729-2.608v-.037c0-1.3-.9-2.522-2.2-2.522H11v4.326A1.82 1.82 0 0 1 9.17 25H8a1 1 0 0 0-1 1H6v-.29c0-.95.765-1.71 1.7-1.71H9a1 1 0 0 0 1-1v-1.03a1 1 0 0 0-.298-.713A5.702 5.702 0 0 1 8 17.19v-1.88C8 14.588 7.412 14 6.69 14H5a1.996 1.996 0 0 1-1.87-1.287c.11.063.236.1.37.1H4a.755.755 0 0 0 .74-.87a1.925 1.925 0 0 0 1.411-1.415zm14.33 10.445a4.026 4.026 0 0 1-1.73.383H12v-1.156h7.8c.386 0 .781.258 1.008.695a1 1 0 0 0-.238.078M10.705 8h2.448c.154 0 .267.148.23.294v.002l-.661 2.63l-.003.01a.746.746 0 0 1-.733.564a.765.765 0 0 1-.73-.553z"/></g></svg>

  </div>
</div>

<script>
    window.addEventListener('load', function() {
      var loadingScreen = document.querySelector('.loading-screen');
      loadingScreen.style.display = 'flex';
  
      setTimeout(function() {
        loadingScreen.style.display = 'none';
      }, 4000); // Adjust the duration in milliseconds (e.g., 2000 for 2 seconds)
    });
  </script>