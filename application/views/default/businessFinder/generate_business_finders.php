<title>Bizora AI || Business Generator</title>

<style>
  .footer-sticky-height,
  .footer-design,
  .sidebar,
  .header-fixed {
    display: none !important;
  }
</style>

<div class="business-generator-wrapper">
  <div class="business-generator-inner">
    <div class="headline-text">
      <div class="headline first">START YOUR BUSINESS</div>
      <div class="headline second">WITH ONE KEYWORD</div>
    </div>
    <div class="search-bar-wrap">
      <input type="text" class="search-input" id="themePrompt" placeholder="Type a business idea... e.g. Dentist, Fitness Coach, Real Estate">
      <a href="javascript:void(0)" class="btn btn-primary action-button" onclick="createAiTemplateApp()">
        Build My Business
        <svg width="22" height="22" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_67_129)">
            <path d="M4.98538 2.7885L5.2865 3.62475C5.621 4.55288 6.35188 5.28375 7.28 5.61825L8.11625 5.91938C8.19163 5.94675 8.19163 6.05363 8.11625 6.08063L7.28 6.38175C6.35188 6.71625 5.621 7.44713 5.2865 8.37525L4.98538 9.2115C4.958 9.28688 4.85113 9.28688 4.82413 9.2115L4.523 8.37525C4.1885 7.44713 3.45763 6.71625 2.5295 6.38175L1.69325 6.08063C1.61788 6.05325 1.61788 5.94638 1.69325 5.91938L2.5295 5.61825C3.45763 5.28375 4.1885 4.55288 4.523 3.62475L4.82413 2.7885C4.85113 2.71275 4.958 2.71275 4.98538 2.7885Z" fill="white" />
            <path d="M8.74965 0.778877L8.90227 1.20225C9.07177 1.67213 9.4419 2.04225 9.91177 2.21175L10.3351 2.36438C10.3734 2.37825 10.3734 2.43225 10.3351 2.44613L9.91177 2.59875C9.4419 2.76825 9.07177 3.13838 8.90227 3.60825L8.74965 4.03163C8.73577 4.06988 8.68177 4.06988 8.6679 4.03163L8.51527 3.60825C8.34577 3.13838 7.97565 2.76825 7.50577 2.59875L7.0824 2.44613C7.04415 2.43225 7.04415 2.37825 7.0824 2.36438L7.50577 2.21175C7.97565 2.04225 8.34577 1.67213 8.51527 1.20225L8.6679 0.778877C8.68177 0.740252 8.73615 0.740252 8.74965 0.778877Z" fill="white" />
            <path d="M8.74965 7.96875L8.90227 8.39213C9.07177 8.862 9.4419 9.23213 9.91177 9.40163L10.3351 9.55425C10.3734 9.56813 10.3734 9.62213 10.3351 9.636L9.91177 9.78863C9.4419 9.95813 9.07177 10.3283 8.90227 10.7981L8.74965 11.2215C8.73577 11.2598 8.68177 11.2598 8.6679 11.2215L8.51527 10.7981C8.34577 10.3283 7.97565 9.95813 7.50577 9.78863L7.0824 9.636C7.04415 9.62213 7.04415 9.56813 7.0824 9.55425L7.50577 9.40163C7.97565 9.23213 8.34577 8.862 8.51527 8.39213L8.6679 7.96875C8.68177 7.9305 8.73615 7.9305 8.74965 7.96875Z" fill="white" />
          </g>
          <defs>
            <clipPath id="clip0_67_129">
              <rect width="12" height="12" fill="white" />
            </clipPath>
          </defs>
        </svg>
      </a>
    </div>
    <div class="keyword-list">
      <button class="keyword-pill">Dentist</button>
      <button class="keyword-pill">Fitness Coach</button>
      <button class="keyword-pill">Real Estate</button>
      <button class="keyword-pill">Restaurant</button>
    </div>
    <img src="<?= $this->config->item('assetsPath') ?>images/business-generator/center-glow.png" class="d-block mx-auto img-fluid mb-2" alt="image">
    <div class="feature-strip">
      <a href="javacript:void(0)" class="feature-item pe-none">
        <span class="icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_794_67)">
              <path d="M11.9498 2.05027C10.6276 0.728111 8.86978 0 7.00001 0C5.13024 0 3.37237 0.728111 2.05027 2.05024C0.728111 3.37237 0 5.13024 0 7.00001C0 8.86978 0.728111 10.6276 2.05027 11.9498C3.37237 13.2719 5.13024 14 7.00001 14C8.86981 14 10.6276 13.2719 11.9498 11.9497C13.2719 10.6276 14 8.86976 14 6.99999C14 5.13022 13.2719 3.37237 11.9498 2.05027ZM2.63091 2.63091C3.24645 2.01538 3.96906 1.54588 4.75667 1.23944C4.54689 1.50134 4.35059 1.80237 4.1707 2.14094C3.96176 2.53414 3.78148 2.96598 3.63134 3.42724C3.11121 3.34092 2.62927 3.23477 2.19872 3.11019C2.33366 2.94433 2.47762 2.7842 2.63091 2.63091ZM1.70158 3.81679C2.20517 3.97803 2.78108 4.11401 3.4095 4.22172C3.2345 4.96454 3.13149 5.76388 3.10691 6.58945H0.83497C0.899502 5.5987 1.19706 4.65315 1.70158 3.81679ZM1.65687 10.1073C1.17958 9.28976 0.89756 8.3715 0.834943 7.41058H3.10847C3.13532 8.21255 3.23628 8.98917 3.40537 9.71255C2.76405 9.81651 2.17367 9.94904 1.65687 10.1073ZM2.63091 11.3691C2.45646 11.1946 2.29398 11.0114 2.14334 10.8207C2.58968 10.697 3.08865 10.5922 3.62576 10.5081C3.77697 10.9758 3.95919 11.4133 4.17067 11.8114C4.36672 12.1803 4.58227 12.5045 4.81352 12.7822C4.00387 12.4764 3.26124 11.9994 2.63091 11.3691ZM6.58942 13.0735C5.96576 12.8988 5.37579 12.3293 4.89585 11.426C4.72799 11.1102 4.58055 10.7656 4.45425 10.3983C5.13046 10.3238 5.85002 10.2798 6.58942 10.2695V13.0735ZM6.58942 9.4483C5.76943 9.45948 4.9702 9.51097 4.22172 9.59888C4.05662 8.91635 3.95728 8.1776 3.93002 7.41061H6.58945V9.4483H6.58942ZM6.58942 6.58942H3.92846C3.95337 5.80099 4.05429 5.04162 4.22454 4.34173C4.96823 4.4347 5.7658 4.49125 6.58942 4.50743V6.58942ZM6.58942 3.68616C5.84714 3.67121 5.12918 3.62281 4.45775 3.54384C4.58329 3.18039 4.72958 2.83924 4.89585 2.52624C5.37576 1.62302 5.96576 1.0535 6.58942 0.878803V3.68616ZM12.3243 3.8604C12.8131 4.68599 13.1016 5.61584 13.1651 6.58942H10.8932C10.8689 5.77337 10.7678 4.983 10.5965 4.2475C11.229 4.14535 11.8121 4.01538 12.3243 3.8604ZM11.3691 2.63091C11.5339 2.79577 11.6879 2.96858 11.8316 3.14798C11.3921 3.26799 10.9027 3.36985 10.3768 3.45183C10.2251 2.98129 10.042 2.54114 9.82936 2.14094C9.64946 1.80237 9.45316 1.50134 9.24338 1.23944C10.0309 1.54588 10.7536 2.01538 11.3691 2.63091ZM7.41061 7.41061H10.07C10.0426 8.18356 9.94191 8.92792 9.77445 9.61485C9.03087 9.5224 8.23366 9.46637 7.41061 9.45062V7.41061ZM7.41061 6.58942V4.51017C8.23106 4.4994 9.03092 4.44834 9.78011 4.36076C9.94759 5.05538 10.0469 5.80812 10.0716 6.58942H7.41061ZM7.41055 0.878803H7.41058C8.03424 1.0535 8.62421 1.62302 9.10415 2.52624C9.27308 2.84417 9.42136 3.19119 9.54821 3.56115C8.8711 3.6353 8.15072 3.67897 7.41055 3.68895V0.878803ZM7.41061 13.0735V10.2719C8.15217 10.2864 8.86959 10.3344 9.54077 10.4129C9.41557 10.7747 9.26977 11.1144 9.10417 11.426C8.62424 12.3293 8.03427 12.8988 7.41061 13.0735ZM11.3691 11.3691C10.7388 11.9994 9.99616 12.4764 9.18648 12.7822C9.41773 12.5045 9.63328 12.1803 9.82933 11.8114C10.0377 11.4192 10.2176 10.9887 10.3675 10.5288C10.8997 10.6166 11.3921 10.7253 11.8308 10.8531C11.6874 11.032 11.5336 11.2045 11.3691 11.3691ZM12.3213 10.1448C11.8117 9.98098 11.2275 9.84314 10.5897 9.73437C10.7619 9.00483 10.8645 8.22061 10.8916 7.41061H13.1651C13.1015 8.38618 12.8119 9.31792 12.3213 10.1448Z" fill="#6B0DF1" />
            </g>
            <defs>
              <clipPath id="clip0_794_67">
                <rect width="14" height="14" fill="white" />
              </clipPath>
            </defs>
          </svg>
        </span>
        Website
      </a>

      <a href="javacript:void(0)" class="feature-item pe-none">
        <span class="icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.55859 14H3.25391C2.04768 14 1.06641 13.0187 1.06641 11.8125V2.1875C1.06641 0.981277 2.04768 0 3.25391 0H8.55859C9.76482 0 10.7461 0.981277 10.7461 2.1875V3.03847C10.7461 3.34053 10.5013 3.58534 10.1992 3.58534C9.89716 3.58534 9.65234 3.34053 9.65234 3.03847V2.1875C9.65234 1.58444 9.16165 1.09375 8.55859 1.09375H3.25391C2.65085 1.09375 2.16016 1.58444 2.16016 2.1875V11.8125C2.16016 12.4156 2.65085 12.9062 3.25391 12.9062H8.55859C9.16165 12.9062 9.65234 12.4156 9.65234 11.8125V10.7767C9.65234 10.4747 9.89716 10.2299 10.1992 10.2299C10.5013 10.2299 10.7461 10.4747 10.7461 10.7767V11.8125C10.7461 13.0187 9.76482 14 8.55859 14ZM6.45313 11.515C6.45313 11.213 6.20831 10.9682 5.90625 10.9682C5.60419 10.9682 5.35938 11.213 5.35938 11.515C5.35938 11.8171 5.60419 12.0619 5.90625 12.0619C6.20831 12.0619 6.45313 11.8171 6.45313 11.515ZM7 2.49159C7 2.18953 6.75519 1.94472 6.45313 1.94472H5.35938C5.05731 1.94472 4.8125 2.18953 4.8125 2.49159C4.8125 2.79366 5.05731 3.03847 5.35938 3.03847H6.45313C6.75519 3.03847 7 2.79366 7 2.49159ZM7.74608 9.73769C7.99442 9.73769 8.23976 9.57405 8.30705 9.33714L9.54916 4.9677C9.64893 4.61703 9.38307 4.26894 9.01564 4.26894C8.7673 4.26894 8.5493 4.43257 8.48201 4.66948L7.2399 9.03903C7.14024 9.38969 7.37865 9.73769 7.74608 9.73769ZM6.32527 9.07738C6.51935 8.84592 6.48901 8.50092 6.25755 8.30695L4.90511 7.17293C4.84839 7.12411 4.83984 7.06291 4.83984 7.03065C4.83984 6.9984 4.84839 6.93719 4.90511 6.88838L6.25755 5.75436C6.48901 5.56039 6.51935 5.21539 6.32527 4.98393C6.1313 4.75258 5.7863 4.72214 5.55484 4.91621L4.20068 6.05162C4.19983 6.05237 4.19887 6.05312 4.19801 6.05397C3.9108 6.29782 3.74609 6.65382 3.74609 7.03065C3.74609 7.40749 3.9108 7.76349 4.19801 8.00734C4.19887 8.00809 4.19972 8.00883 4.20068 8.00969L5.55484 9.1451C5.65727 9.23097 5.78192 9.27284 5.90593 9.27284C6.06209 9.27284 6.21718 9.2063 6.32527 9.07738ZM11.129 9.14146L12.4543 8.00734C12.7415 7.76349 12.9063 7.40749 12.9063 7.03065C12.9063 6.65382 12.7415 6.29782 12.4558 6.05525L11.129 4.91985C10.8995 4.72342 10.5543 4.75034 10.3579 4.97977C10.1615 5.2093 10.1884 5.55452 10.4179 5.75084L11.7463 6.88753C11.8038 6.93645 11.8125 6.99818 11.8125 7.03065C11.8125 7.06302 11.804 7.12476 11.7448 7.17496L10.4179 8.31047C10.1884 8.50679 10.1615 8.85201 10.3579 9.08144C10.4661 9.2079 10.6194 9.27284 10.7738 9.27284C10.8995 9.27284 11.0259 9.22969 11.129 9.14146Z" fill="#6B0DF1" />
          </svg>
        </span>
        Mobile App
      </a>

      <a href="javacript:void(0)" class="feature-item pe-none">
        <span class="icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_794_77)">
              <path d="M12.6875 4.92188H11.7031V4.375C11.7031 2.26398 9.9856 0.546875 7.875 0.546875H6.125C4.0144 0.546875 2.29688 2.26398 2.29688 4.375V4.92188H1.3125C0.649414 4.92188 0.109375 5.46149 0.109375 6.125V8.75C0.109375 9.41351 0.649414 9.95312 1.3125 9.95312H2.33004C2.4957 11.4255 3.7337 12.5781 5.25 12.5781H5.41064C5.55463 13.0815 6.01386 13.4531 6.5625 13.4531H7.4375C8.10059 13.4531 8.64062 12.9135 8.64062 12.25C8.64062 11.5865 8.10059 11.0469 7.4375 11.0469H6.5625C6.01386 11.0469 5.55463 11.4185 5.41064 11.9219H5.25C3.98364 11.9219 2.95312 10.8914 2.95312 9.625V4.375C2.95312 2.62585 4.37585 1.20312 6.125 1.20312H7.875C9.62415 1.20312 11.0469 2.62585 11.0469 4.375V9.625C11.0469 9.80615 11.1938 9.95312 11.375 9.95312H12.6875C13.3506 9.95312 13.8906 9.41351 13.8906 8.75V6.125C13.8906 5.46149 13.3506 4.92188 12.6875 4.92188ZM6.5625 11.7031H7.4375C7.73914 11.7031 7.98438 11.9484 7.98438 12.25C7.98438 12.5516 7.73914 12.7969 7.4375 12.7969H6.5625C6.26086 12.7969 6.01562 12.5516 6.01562 12.25C6.01562 11.9484 6.26086 11.7031 6.5625 11.7031ZM0.765625 8.75V6.125C0.765625 5.82336 1.01086 5.57812 1.3125 5.57812H2.29688V9.29688H1.3125C1.01086 9.29688 0.765625 9.05164 0.765625 8.75ZM13.2344 8.75C13.2344 9.05164 12.9891 9.29688 12.6875 9.29688H11.7031V5.57812H12.6875C12.9891 5.57812 13.2344 5.82336 13.2344 6.125V8.75Z" fill="#6B0DF1" />
              <path d="M6.56239 4.48438H6.12489C5.98134 4.48438 5.85488 4.57751 5.8113 4.71466L4.71755 8.21466C4.66371 8.3877 4.76027 8.57184 4.93288 8.62567C5.10976 8.68079 5.29006 8.58337 5.34474 8.41034L5.54614 7.76562H7.14115L7.34255 8.41034C7.38698 8.5509 7.51601 8.64062 7.65614 8.64062C7.68862 8.64062 7.72109 8.63593 7.75441 8.62567C7.92702 8.57184 8.02358 8.3877 7.96974 8.21466L6.87599 4.71466C6.83241 4.57751 6.70595 4.48438 6.56239 4.48438ZM5.75111 7.10938L6.34364 5.2124L6.93618 7.10938H5.75111Z" fill="#6B0DF1" />
              <path d="M8.96875 4.48438C8.7876 4.48438 8.64062 4.63135 8.64062 4.8125V8.3125C8.64062 8.49365 8.7876 8.64062 8.96875 8.64062C9.1499 8.64062 9.29688 8.49365 9.29688 8.3125V4.8125C9.29688 4.63135 9.1499 4.48438 8.96875 4.48438Z" fill="#6B0DF1" />
            </g>
            <defs>
              <clipPath id="clip0_794_77">
                <rect width="14" height="14" fill="white" />
              </clipPath>
            </defs>
          </svg>
        </span>
        AI Agent
      </a>

      <a href="javacript:void(0)" class="feature-item pe-none">
        <span class="icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_794_77)">
              <path d="M12.6875 4.92188H11.7031V4.375C11.7031 2.26398 9.9856 0.546875 7.875 0.546875H6.125C4.0144 0.546875 2.29688 2.26398 2.29688 4.375V4.92188H1.3125C0.649414 4.92188 0.109375 5.46149 0.109375 6.125V8.75C0.109375 9.41351 0.649414 9.95312 1.3125 9.95312H2.33004C2.4957 11.4255 3.7337 12.5781 5.25 12.5781H5.41064C5.55463 13.0815 6.01386 13.4531 6.5625 13.4531H7.4375C8.10059 13.4531 8.64062 12.9135 8.64062 12.25C8.64062 11.5865 8.10059 11.0469 7.4375 11.0469H6.5625C6.01386 11.0469 5.55463 11.4185 5.41064 11.9219H5.25C3.98364 11.9219 2.95312 10.8914 2.95312 9.625V4.375C2.95312 2.62585 4.37585 1.20312 6.125 1.20312H7.875C9.62415 1.20312 11.0469 2.62585 11.0469 4.375V9.625C11.0469 9.80615 11.1938 9.95312 11.375 9.95312H12.6875C13.3506 9.95312 13.8906 9.41351 13.8906 8.75V6.125C13.8906 5.46149 13.3506 4.92188 12.6875 4.92188ZM6.5625 11.7031H7.4375C7.73914 11.7031 7.98438 11.9484 7.98438 12.25C7.98438 12.5516 7.73914 12.7969 7.4375 12.7969H6.5625C6.26086 12.7969 6.01562 12.5516 6.01562 12.25C6.01562 11.9484 6.26086 11.7031 6.5625 11.7031ZM0.765625 8.75V6.125C0.765625 5.82336 1.01086 5.57812 1.3125 5.57812H2.29688V9.29688H1.3125C1.01086 9.29688 0.765625 9.05164 0.765625 8.75ZM13.2344 8.75C13.2344 9.05164 12.9891 9.29688 12.6875 9.29688H11.7031V5.57812H12.6875C12.9891 5.57812 13.2344 5.82336 13.2344 6.125V8.75Z" fill="#6B0DF1" />
              <path d="M6.56239 4.48438H6.12489C5.98134 4.48438 5.85488 4.57751 5.8113 4.71466L4.71755 8.21466C4.66371 8.3877 4.76027 8.57184 4.93288 8.62567C5.10976 8.68079 5.29006 8.58337 5.34474 8.41034L5.54614 7.76562H7.14115L7.34255 8.41034C7.38698 8.5509 7.51601 8.64062 7.65614 8.64062C7.68862 8.64062 7.72109 8.63593 7.75441 8.62567C7.92702 8.57184 8.02358 8.3877 7.96974 8.21466L6.87599 4.71466C6.83241 4.57751 6.70595 4.48438 6.56239 4.48438ZM5.75111 7.10938L6.34364 5.2124L6.93618 7.10938H5.75111Z" fill="#6B0DF1" />
              <path d="M8.96875 4.48438C8.7876 4.48438 8.64062 4.63135 8.64062 4.8125V8.3125C8.64062 8.49365 8.7876 8.64062 8.96875 8.64062C9.1499 8.64062 9.29688 8.49365 9.29688 8.3125V4.8125C9.29688 4.63135 9.1499 4.48438 8.96875 4.48438Z" fill="#6B0DF1" />
            </g>
            <defs>
              <clipPath id="clip0_794_77">
                <rect width="14" height="14" fill="white" />
              </clipPath>
            </defs>
          </svg>
        </span>
        Leads
      </a>

      <a href="javacript:void(0)" class="feature-item pe-none">
        <span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <mask id="mask0_794_100" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
              <path d="M14 0H0V14H14V0Z" fill="white" />
            </mask>
            <g mask="url(#mask0_794_100)">
              <path d="M3.28125 3.08984H10.7187" stroke="#6B0DF1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M3.28125 5.27734H10.7187" stroke="#6B0DF1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M3.28125 7.46484H5.79687" stroke="#6B0DF1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
              <mask id="mask1_794_100" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                <path d="M0 9.53674e-07H14V14H0V9.53674e-07Z" fill="white" />
              </mask>
              <g mask="url(#mask1_794_100)">
                <path d="M8.59584 10.137L7.98438 7.92967L10.137 8.58351L13.1328 11.586C13.5599 12.0131 13.5599 12.7056 13.1328 13.1328C12.7056 13.5599 12.0131 13.5599 11.586 13.1328L8.59584 10.137Z" stroke="#6B0DF1" stroke-miterlimit="10" stroke-linejoin="round" />
                <path d="M12.5371 11.1973L11.252 12.4824" stroke="#6B0DF1" stroke-miterlimit="10" stroke-linejoin="round" />
                <path d="M8.88672 13.4531H2.1875C1.28141 13.4531 0.546875 12.7186 0.546875 11.8125V2.1875C0.546875 1.28141 1.28141 0.546876 2.1875 0.546876H11.8125C12.7186 0.546876 13.4531 1.28141 13.4531 2.1875V8.91406" stroke="#6B0DF1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
              </g>
            </g>
          </svg>
        </span>
        Content
      </a>
      <div class="content-wrap">

        <button class="btn btn-sm btn-primary-alt pe-none">
          AUTO - BUILT
        </button>
      </div>
    </div>

  </div>
</div>
<div id="videoLoaderOverlay" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100vh; background: rgba(0,0,0,0.9); z-index: 9999; justify-content: center; align-items: center; flex-direction: column; color: white; border-radius: 8px;">

  <video id="loaderVideo" autoplay muted loop playsinline preload="auto"
    style="width: 100%; height: 100%; object-fit: contain; position: absolute; top: 0; left: 0; border-radius: 8px;">
    <source src="<?php echo base_url(); ?>app/assets/images/bizora_loader.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <p id="loaderText" style="position: relative; z-index: 10000; font-size: 20px; font-family: 'Segoe UI', Arial, sans-serif; text-align: center; background: rgba(0,0,0,0.5); padding: 10px 20px; border-radius: 5px;"></p>
</div>
<script>
  function createAiTemplateApp() {
    const prompt = document.getElementById('themePrompt').value.trim();
    if (!prompt) {
      flashNow({
        'error': {
          'message': "Please enter prompt!"
        }
      });

      return false;
    }
    let newThemeName = prompt;
    $('#videoLoaderOverlay').css('display', 'flex');
    //jsLoader(true);
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('save-ai-prompt'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompt,
          project_name: newThemeName
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {
          console.log(data.redirect + '?theme=' + data.used_folder);


          email_sequances_default(prompt);

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function email_sequances_default(prompts) {
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('emails-sequances-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          emails_promotions_default(prompts);

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function emails_promotions_default(prompts) {
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('emails-promotions-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          social_mediacontent_default(prompts);

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function social_mediacontent_default(prompts) {
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('social-mediacontent-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          agents_default(prompts);

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function agents_default(prompts) {
    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('agent-create-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {

        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          find_inplace_default(prompts);

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }

  function find_inplace_default(prompts) {



    const btn = this;
    btn.disabled = true;
    const previousHtml = btn.innerHTML;
    btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Generating...
                  `;

    fetch("<?= base_url('find-inplace-default'); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        credentials: "include",
        body: JSON.stringify({
          prompt: prompts
        })
      })

      .then(response => {
        //jsLoader(false);
        $('#videoLoaderOverlay').hide();
        return response.text().then(text => ({
          ok: response.ok,
          status: response.status,
          text
        }));
      })
      .then(({
        ok,
        status,
        text
      }) => {
        console.log("Raw server response:", text);

        let data;
        try {
          data = JSON.parse(text);
        } catch (e) {

          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (!ok) {

          const msg = data.message || `Server returned status ${status}`;
          btn.disabled = false;
          btn.innerHTML = previousHtml;
          return;
        }

        if (data.status == "success") {

          window.location.href = "<?= base_url('business-generator-list'); ?>";
          setTimeout(() => {

          }, 500);

        }
      })
      .catch(error => {
        console.error("Fetch error:", error);
        btn.disabled = false;
        btn.innerHTML = previousHtml;
      });

  }



  function jsLoader(add) {
    if (add === undefined) {
      add = false;
    }
    $(".temp_js_loader").remove();
    if (add) {
      $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999999;">\
        		<img src="<?php echo $this->config->item("assetsTemplatePath"); ?>images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; width:120px;">\
        		</div>');
    }
  }
</script>
<script>
  $(document).ready(function() {
    let angle = 95;

    function rotateGradient() {
      angle = (angle + 1) % 360;
      $('.search-bar-wrap').css('--angle', angle + 'deg');
      requestAnimationFrame(rotateGradient);
    }
    rotateGradient();
  });
</script>

<script>
  $(document).on('click', '.keyword-pill', function() {
    const value = $.trim($(this).text());

    const $wrapper = $(this).closest('.launch-panel'); // optional scope
    const $input = $wrapper.length ?
      $wrapper.find('.search-input') :
      $('.search-input');

    $input.val(value).focus();
  });
</script>