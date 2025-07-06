 <div class="page-header">
     <h1 class="page-title">Kategorije</h1>
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="#">Početna</a></li>
             <li class="breadcrumb-item active" aria-current="page">Kategorije</li>
         </ol>
     </nav>
 </div>

 <!-- Kategorije -->
 <div class="card fade-in">
     <div class="card-header d-flex justify-content-between align-items-center">
         <h5 class="mb-0">Nova kategorija</h5>
     </div>

     <div class="card-body">
         <form action="categories#categories" method="POST" class="row gy-2 gx-3 align-items-center mb-4">
             <?php include 'flash-messages.php'; ?>

             <div class="col-sm-8">
                 <label class="visually-hidden" for="categoryName">Naziv kategorije</label>
                 <input type="text" class="form-control" id="categoryName" name="categoryName"
                     placeholder="Unesite naziv nove kategorije" autocomplete="off" required>
             </div>

             <div class="col-sm-4 text-end">
                 <button type="submit" class="btn btn-primary w-100" name="createCategoryBtn">
                     <i class="bi bi-plus-circle me-1"></i> Dodaj kategoriju
                 </button>
             </div>
         </form>

         <!-- Tablica kategorija -->
         <div class="table-responsive">
             <table class="table table-hover align-middle">
                 <thead class="table-light">
                     <tr>
                         <th>#</th>
                         <th>Naziv</th>
                         <th>Broj postova</th>
                         <th>Kreirano</th>
                         <th>Akcije</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $categories = categoriesController::all(); ?>

                     <?php if (empty($categories)): ?>
                         <tr>
                             <td colspan="5" class="text-center text-muted">Nema dostupnih kategorija.</td>
                         </tr>
                     <?php else: ?>
                         <?php foreach ($categories as $index => $cat): ?>
                             <tr>
                                 <td><?= $index + 1 ?></td>
                                 <td><?= htmlspecialchars($cat['name']) ?></td>
                                 <td>0</td>
                                 <td><?= date('d.m.Y.', $cat['created_at']) ?></td>
                                 <td>
                                     <div class="d-flex">
                                         <a href="/cms/categories/delete/<?= $cat['id'] ?>" class="btn btn-outline-danger btn-sm" title="Obriši">
                                             <i class="bi bi-trash"></i>
                                         </a>
                                     </div>
                                 </td>
                             </tr>
                         <?php endforeach; ?>
                     <?php endif; ?>

                 </tbody>
             </table>
         </div>
     </div>
 </div>
