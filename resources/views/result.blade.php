<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>AVS Report</title>
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
      />
  
      <style>
        * {
          box-sizing: border-box;
          font-family: "Nunito", sans-serif;
          padding: 0;
          margin: 0;
        }
  
        body {
          margin: 0;
          /* padding: 1.5rem 3.5rem; */
          /* width: 3152px; */
          width: 1600px;
          /* width: fit-content; */
          margin: auto;
          display: flex;
          background-color: #f8f8f8;
        }
  
        /* Aside */
        aside {
          width: 550px;
          /* width: fit-content; */
          background-color: #fff;
          padding: 1.5rem 5rem;
        }
  
        aside .header-logo {
          background-color: #004071;
          width: 5rem;
          height: 5rem;
          border-radius: 1rem;
          /* padding: 1rem; */
          display: grid;
          place-items: center;
          /* align-items: center; */
        }
  
        aside h1 {
          font-size: 2.5rem;
          line-height: 1.2;
          font-weight: 800;
          margin: 1rem 0;
          color: #242f40;
        }
  
        aside .address {
          color: #8a8a8a;
          text-transform: uppercase;
          font-weight: 700;
          font-size: 0.875rem;
        }
  
        aside ul {
          margin: 1rem 0;
          display: flex;
          color: #242f40;
          align-items: center;
        }
  
        aside ul li:first-of-type {
          list-style: none;
          margin-right: 2rem;
        }
  
        aside div .status {
          border-radius: 0.35rem;
          text-transform: uppercase !important;
          padding: 0.45rem 0.75rem;
          font-weight: 700;
          display: inline-flex;
          align-items: center;
          font-size: 1.25rem;
        }
  
        aside div .status span {
          height: 15px;
          width: 15px;
          border-radius: 4px;
          display: inline-block;
          margin-right: 7px;
        }
  
        aside div .success.status {
          background-color: #e8fbf3;
          color: #263141;
        }
  
        aside div .success.status span {
          background-color: #17dc89;
        }

        aside div .danger.status span {
          background-color: #dc1724;
        }
  
        aside div .fail.status {
          background-color: #ff00001e;
          color: #263141;
        }
  
        aside div .fail.status span {
          background-color: #ff000052;
        }
  
        aside .images {
          display: grid;
          grid-template-columns: repeat(2, minmax(0, 1fr));
          grid-gap: 1rem;
          gap: 2rem;
        }
  
        aside .images img {
          object-fit: cover;
          width: 100%;
        }
  
        main {
          width: 69%;
          background-color: #f8f8f8;
          padding: 3rem 5rem;
          border-radius: 1rem;
        }
  
        main section {
          background-color: white;
          width: 100%;
          height: 100%;
          padding: 1.5rem;
          border-top: 6px solid #004071;
          border-radius: 0.5rem;
        }
  
        main table {
          width: 100%;
        }
        main table tr {
          display: grid;
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        main table td {
          /* width: 50%; */
          padding: 0 1rem;
        }
  
        main .theDiv {
          display: flex;
          flex-direction: column;
          margin: 2rem 0;
        }
  
        main .theDiv label {
          font-size: 13px;
          font-weight: 700;
          letter-spacing: 0.1em;
          text-transform: uppercase;
          color: #96989ab7;
          margin-bottom: 0.5rem;
        }
  
        main .theDiv p {
          color: #242f40;
          font-weight: 700;
          font-size: 24px;
        }
      </style>
    </head>
    <body>
      <aside>
      
        <div class="header-logo">
          <img
            width="25"
            src="https://ministry-of-interior-pwbz4.ondigitalocean.app/assets/admin/images/header-logo.svg"
            alt=""
          />
        </div>
        <h1>
          Address
          Verification Report
        </h1>
        <p class="address">{{ $inner_array[1] }}</p>
        <ul>
          <li>{{ $inner_array['13'] }}</li>
          <!-- <li>09:09:28 PM</li> -->
        </ul>
  
        <div
          style="
            border-top: 5px solid #f8f8f8;
            border-bottom: 5px solid #f8f8f8;
            padding: 1rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
          "
        >
          <span
            style="
              text-transform: uppercase;
              color: #8b8b8b;
              font-weight: 700;
              letter-spacing: 1.5px;
              font-size: 0.875rem;
            "
            >Verification Status</span
          >

          <?php 
            if($inner_array[2] == 'Verified') {
              echo "<span class='status success'><span></span>Verified</span>";
            }
            elseif($inner_array[2] == 'Not Verified') {
              echo "<span class='status danger'><span></span>Not Verified</span>";
            }
          ?>      
        </div>
  
        <div
          class="note"
          style="
            border: 1px solid #e7e7e7;
            border-radius: 1rem;
            padding: 1rem;
            margin: 1rem 0;
            font-size: 0.875rem;
          "
        >
          <b>Note:</b> This only verifies that the candidate resides at the
          location at the time of verification
        </div>
  
        <div class="images">
          <!-- <img src='.$sub['image'].' /> <img src='.$sub['image2'].' /> -->
          <img src='{{ $inner_array[3] }}' />
          <img src='{{ $inner_array[3] }}' />
        </div>
  
      </aside>
    
      <main>
        <section>
          <table>
         
            <tr>
              <td>
                <div
                  style="
                    padding: 2rem;
                    border-radius: 50%;
                    border: 4px solid #cccccc8a;
                    display: inline-block;
                  "
                >
                
                  <img
                    style="width: 100px; opacity: 0.4"
                    src="https://ministry-of-interior-pwbz4.ondigitalocean.app/assets/admin/images/avatar.png"
                  />
                </div>
              </td>
              <td>
                <img
                  src="https://ministry-of-interior-pwbz4.ondigitalocean.app/assets/admin/images/smile-id.png"
                />
              </td>
            </tr>
            <tr>
              <td class="theDiv">
                <label for="">Full Name</label>
                <p>{{ $inner_array[0] }}</p>
              </td>
            </tr>
            <tr>
              <td class="theDiv">
                <label for="">Address</label>
                <p>{{ $inner_array[1] }}</p>
              </td>
              <td class="theDiv">
                <label for="">Interviewed At Residence</label>
                <p>{{ $inner_array[11] }}</p>
              </td>
            </tr>
            <tr>
              <td class="theDiv">
                <label for="">Description of Building/Landmark</label>
                <p>{{ $inner_array[9] }}</p>
              </td>
              <td class="theDiv">
                <label for="">Comments</label>
                <p>{{ $inner_array[10] }}</p>
              </td>
            </tr>
            <tr>
              <td class="theDiv">
                <label for="">GPS Coordinate</label>
                <p>{{ $inner_array[4] }}</p>
              </td>
              <td class="theDiv">
                <label for="">Verification Officer</label>
                <p>{{ $inner_array[12] }}</p>
              </td>
            </tr>
        
          </table>
        </section>
      </main>
    </body>
  </html>
  